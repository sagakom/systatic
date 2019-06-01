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
    Configuration
    - Use the Laravel Configuration helpers
*/

if (! function_exists('config')) {
    function config($key = null, $default = null)
    {
        if (is_null($key)) {
            return app('config');
        }
        if (is_array($key)) {
            return app('config')->set($key);
        }
        return app('config')->get($key, $default);
    }
}

if (! function_exists('config_path')) {
    function config_path($path = '')
    {
        return app()->make('path.config').($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}