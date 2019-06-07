<?php

use Damcclean\Systatic\Config\Config;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\VarDumper\VarDumper;

/*
    Helpers
    - Systatic uses this file to add PHP functions that are needed throughout the application.
    - You can use these helpers within your Blade views.
*/

/*
    Die dumps
    - Dumps then dies
*/

if (!function_exists('dd')) {
    function dd(...$args)
    {
        foreach ($args as $x) {
            (new VarDumper())->dump($x);
        }

        die();
    }
}

/*
    Logging
    - Dump data into a log file
    - Useful for debugging broken code
*/

if(!function_exists('logging')) {
    function logging($message)
    {
        $file = (new Config)->getConfig('locations.storage') . '/systatic.log';

        if(!file_exists($file)) {
            (new Filesystem)->touch($file);
        }

        (new Filesystem)->appendToFile($file, $message);
    }
}

/*
    Configuration path
    - Get the path of the configuration file
*/

if(!function_exists('config_path')) {
    function config_path() {
        return CONFIG;
    }
}

/*
    Env key
    - Get value from env file
*/

if(!function_exists('env')) {
    $config = new Config();

    function env($key) 
    {
        return $config->env($key);
    }
}