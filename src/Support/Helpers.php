<?php

use Damcclean\Systatic\Config\Config;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\VarDumper\VarDumper;

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
        $file = (new Config)->getConfig('storageDir') . '/systatic.log';

        if(!file_exists($file)) {
            (new Filesystem)->touch($file);
        }

        (new Filesystem)->appendToFile($file, $message);
    }
}