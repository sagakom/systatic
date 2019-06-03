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
        $config = include('./config.php');
        return $config[$setting];
    }

    public function getConfigArray()
    {
        $config = include('./config.php');
        return $config;
    }

    public function getEnv($setting)
    {
        $this->env->load('./.env', './.sample.env', './.example.env');

        $setting = getenv($setting);
        return $setting;
    }
}
