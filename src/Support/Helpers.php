<?php

use Damcclean\Systatic\Config\Config;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\VarDumper\VarDumper;
use Damcclean\Systatic\Collections\Collections;

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
    function env($key) 
    {
        $config = new Config();
        return $config->env($key);
    }
}

/*
    Meta key existance check
    - Checks if a key exists on the meta array
    - Uses the array_key_exists function
*/

if(!function_exists('meta_exists')) {
    function meta_exists($meta, $key) {
        if(array_key_exists($key, $meta)) {
            return true;
        }

        return false;
    }
}

/*
    Route helper
    - Links to a Systatic URL using it's slug
    - Links to a redirect link
*/

if(!function_exists('route')) {
    function route($slug) {
        $config = new Config();
        $collections = new Collections();

        $siteUrl = $config->get('url');

        if(array_key_exists('redirects', $config->getArray())) {
            foreach($config->getArray()['redirects'] as $redirect) {
                if($redirect['slug'] === $slug) {
                    return $siteUrl . '/' . $slug . '.html';
                }
            }
        }

        foreach($collections->fetch() as $item) {
            if($item['slug'] === $slug) {
                return $siteUrl . '/' . $slug . '.html';
            }
        }

        return '';
    }
}

/*
    String starts with
*/

if(!function_exists('startsWith')) {
    function startsWith ($string, $starting) 
    { 
        $len = strlen($starting); 
        return (substr($string, 0, $len) === $starting); 
    } 
}

/*
    String ends with
*/

if(!function_exists('endsWith')) {
    function endsWith ($string, $ending)
    {
        $strLength = strlen ($string);
        $endsLength = strlen ($ending);

        for ($i = 0; $i < $endsLength; $i++) {
            if ($string [$strLength - $i - 1] !== $ending [$i]) {
                return false;
            }
        }

        return true;
    }
}