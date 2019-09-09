<?php

use Carbon\Carbon;
use Damcclean\Systatic\Config\Config;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\VarDumper\VarDumper;
use Damcclean\Systatic\Collections\Collections;

function dd(...$args)
{
    foreach ($args as $x) {
        (new VarDumper())->dump($x);
    }

    die();
}

function env($key)
{
    return (new Config())->env($key);
}

function startsWith($string, $starting)
{
    $len = strlen($starting);

    return substr($string, 0, $len) === $starting;
}


function endsWith($string, $ending)
{
    $strLength = strlen($string);
    $endsLength = strlen($ending);

    for ($i = 0; $i < $endsLength; $i++) {
        if ($string [$strLength - $i - 1] !== $ending [$i]) {
            return false;
        }
    }

    return true;
}

function file_write_contents($path, $content)
{
    $filesystem = new Filesystem();
    $directory = pathinfo($path, PATHINFO_DIRNAME);

    if (! file_exists($directory)) {
        $filesystem->makeDirectory($directory, 0755, true, true);
    }

    return (bool) file_put_contents($path, $content);
}

function convert_to_object($array)
{
    return json_decode(json_encode($array, JSON_FORCE_OBJECT));
}

function output_path()
{
    return (new Damcclean\Systatic\Config\Config())->get('locations.output');
}

function views_path()
{
    return (new Damcclean\Systatic\Config\Config())->get('locations.views');
}

function storage_path()
{
    return (new Damcclean\Systatic\Config\Config())->get('locations.storage');
}

function config_path()
{
    return CONFIG;
}