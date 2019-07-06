<?php

namespace Damcclean\Systatic\Config;

use Illuminate\Config\Repository;
use Symfony\Component\Dotenv\Dotenv;

class Config
{
    public function __construct()
    {
        $this->env = new Dotenv();
        $this->config = new Repository(require CONFIGURATION);
    }

    public function get($key)
    {
        return $this->config->get($key);
    }

    public function getArray()
    {
        $config = include(CONFIGURATION);
        return $config;
    }

    public function updateArray($data)
    {
        $config = include(CONFIGURATION);
        $config = array_merge($config, $data);

        // Update the config file with the updated array

        return $config;
    }

    public function env($key)
    {
        $env = $this->env->load(BASE . '/.env');
        return $_ENV[$key];
    }
}
