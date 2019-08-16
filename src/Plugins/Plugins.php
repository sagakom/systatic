<?php

namespace Damcclean\Systatic\Plugins;

use Damcclean\Systatic\Store;
use Damcclean\Systatic\Config\Config;

class Plugins extends Store
{
    public $name = 'plugins';
    protected $pluginData = [];

    public function __construct()
    {
        $this->config = new Config();
    }

    public function find()
    {
        if (array_key_exists('plugins', $this->config->getArray())) {
            foreach ($this->config->getArray()['plugins'] as $plugin) {
                $p = new $plugin();

                $data = [];
                $data["{$plugin}"] = [
                    'name' => null,
                    'provider' => $plugin
                ];

                array_push($this->pluginData, $data);

                $p->boot();
            }
        }

        $this->store($this->pluginData);
    }

    public function setupConsole($c)
    {
        $all = [];
        $plugin = new $c();
        $commands = $plugin->commands();

        foreach ($commands as $command) {
            array_push($all, $command);
        }

        array_push($this->storeData["test"], $all);

        return (new Console())->save($this->storeData);
    }
}
