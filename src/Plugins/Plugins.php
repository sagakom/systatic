<?php

namespace Damcclean\Systatic\Plugins;

use Damcclean\Systatic\Config\Config;

class Plugins
{
    public function __construct()
    {
        $this->config = new Config();

        $this->store = [];
    }

    public function save($store)
    {
        return (bool) file_put_contents($this->config->get('locations.storage') . '/plugins.json', json_encode($store));
    }

    public function fetch()
    {
        return json_decode(file_get_contents($this->config->get('locations.storage') . '/plugins.json'), true);
    }

    public function find()
    {
        if (array_key_exists('plugins', $this->config->getArray())) {
            foreach ($this->config->getArray()['plugins'] as $plugin) {
                $p = new $plugin();
                $p = $p->boot();

                array_push($this->store, $p);
            }
        }

        $this->save($this->store);
    }

    public function commands()
    {
        $plugins = $this->fetch();
        $allCommands = [];

        foreach ($plugins as $plugin) {
            if (array_key_exists('commands', $plugin)) {
                $pluginCommands = $plugin['commands'];

                $commands = new $pluginCommands();
                $commands = $commands->console();

                foreach ($commands as $command) {
                    array_push($allCommands, $command);
                }
            }
        }

        return $allCommands;
    }
}
