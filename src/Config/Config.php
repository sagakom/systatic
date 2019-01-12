<?php

namespace Thunderbird\Config;

use Symfony\Component\Dotenv\Dotenv;

class Config
{
    public function getConfig($setting) 
    {
        $config = include('./config.php');

        if(array_key_exists($setting, $config))
        {
            $setting = key($setting);
            return $setting;
        } else
        {
            $this->getEnv($setting);
        }
    }

    public function getEnv($setting)
    {
        $dotenv = new Dotenv();
        $dotenv->load('./sample.env', './.env');

        $setting = getenv($setting);
        return $setting;
    }
}