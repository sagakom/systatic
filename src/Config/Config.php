<?php

namespace Damcclean\Systatic\Config;

use Symfony\Component\Dotenv\Dotenv;

class Config
{
    public function __construct()
    {
        $this->env = new Dotenv();
    }

    public function getConfig($setting)
    {
        $config = include(CONFIG);
        return $config[$setting];
    }

    public function getConfigArray()
    {
        $config = include(CONFIG);
        return $config;
    }

    public function getEnv($setting)
    {
        $this->env->load('./.env', './sample.env');

        $setting = getenv($setting);
        return $setting;
    }
}
