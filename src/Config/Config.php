<?php

namespace Damcclean\Systatic\Config;

use Symfony\Component\Dotenv\Dotenv;

class Config
{
    public function __construct()
    {
        $this->env = new Dotenv();
    }

    /*
        Get config value
    */

    public function getConfig($setting)
    {
        $config = include(CONFIG);
        return $config[$setting];
    }

    /*
        Get config array
    */

    public function getConfigArray()
    {
        $config = include(CONFIG);
        return $config;
    }

    /*
        Get env value
    */

    public function getEnv($setting)
    {
        $this->env->load('./.env', './sample.env');

        $setting = getenv($setting);
        return $setting;
    }
}
