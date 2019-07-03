<?php

use Damcclean\Systatic\Config\Config;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\VarDumper\VarDumper;
use Damcclean\Systatic\Filesystem\Filesystem as SystaticFilesystem;
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
    function startsWith($string, $starting) 
    { 
        $len = strlen($starting); 
        return (substr($string, 0, $len) === $starting); 
    } 
}

/*
    String ends with
*/

if(!function_exists('endsWith')) {
    function endsWith($string, $ending)
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

/*
    Write to file
    - Creates a file, along with any directories needed
    - Also writes content to the file
*/

if(!function_exists('file_write_contents')) {
    function file_write_contents($path, $content) {
        $filesystem = new SystaticFilesystem();

        $dirName = pathinfo($path, PATHINFO_DIRNAME);

        if(!file_exists($dirName)) {
            $filesystem->createDirectory($dirName);
        }

        return (bool) file_put_contents($path, $content);
    }
}

/*
    Convert arrays into an object
    - Works with nested arrays
*/

if(!function_exists('convert_to_object')) {
    function convert_to_object($array) {
        $object = new stdClass;

        foreach($array as $key => $value) {
            if(strlen($key)) {
                if(is_array($key)) {
                    $object->{$key} = convert_to_object($value);
                } else {
                    $object->{$key} = $value;
                }
            }
        }

        return $object;
    }
}