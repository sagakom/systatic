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
        file_put_contents($this->config->get('locations.storage') . '/plugins.json', json_encode($store));
        return true;
    }

    public function fetch()
    {
        return json_decode(file_get_contents($this->config->get('locations.storage') . '/plugins.json'), true);
    }

    public function register()
    {
        foreach($this->config->getArray()['plugins'] as $plugin) {
            $p = new $plugin();
            $p = $p->boot();

            array_push($this->store, $p);
        }

        $this->save($this->store);
    }
}