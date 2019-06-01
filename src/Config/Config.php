<?php

namespace Damcclean\Systatic\Config;

use Illuminate\Config\Repository;
use Symfony\Component\Dotenv\Dotenv;

class Config
{
    public function __construct()
    {
        $this->env = new Dotenv();
        $this->config = new Repository(require CONFIG);
    }

    /*
        Get a configuration value
    */

    public function get($key)
    {
        return $this->config->get($key);
    }

    /*
        Get the configuration file as an array
    */

    public function getArray()
    {
        $config = include(CONFIG);
        return $config;
    }

    /*
        Get value from enviroment file
    */

    public function env($key)
    {
        $this->env->load('./.env', './sample.env');
        $setting = getenv($key);
        return $setting;
    }
}
