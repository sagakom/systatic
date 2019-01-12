<?php

namespace Thunderbird\Config;

use Symfony\Component\Dotenv\Dotenv;

class Config
{
    public function getConfig($setting) {
        $dotenv = new Dotenv();
        $dotenv->load('./sample.env', './.env');

        $setting = getenv($setting);
        return $setting;
    }
}