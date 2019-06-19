<?php

namespace Damcclean\Systatic\Plugins;

use Damcclean\Systatic\Config\Config;

class Plugins
{
    public function __construct()
    {
        $this->plugins = [];

        $this->config = new Config();
    }

    public function find()
    {
        $location = './plugins';

        if(array_key_exists('plugins', $this->config->getArray()['locations'])) {
            $location = $this->config->get('locations.plugins');
        }

        $this->plugins = array_merge(glob($location . '/*.php', GLOB_BRACE), $this->plugins);
    }

    public function beforeBuild()
    {
        $this->find();

        foreach($this->plugins as $plugin) {
            $include = include $plugin;
            before();
        }
    }

    public function afterBuild()
    {
        $this->find();

        foreach($this->plugins as $plugin) {
            $include = include $plugin;
            after();
        }
    }
}