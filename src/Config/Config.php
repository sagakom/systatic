<?php

namespace Thunderbird\Config;

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

    public function getEnv($setting)
    {
        $this->env->load('./.env', './sample.env');

        $setting = getenv($setting);
        return $setting;
    }
}