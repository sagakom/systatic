<?php

namespace Damcclean\Systatic\Logging;

use Damcclean\Systatic\Config\Config;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class Logging
{
    public function __construct()
    {
        $this->filesystem = new Filesystem();
        $this->config = new Config();
    }

    /*
        Create a log file and write to it
    */

    public function log($message)
    {
        $fileExists = file_exists($this->config->getConfig('storageDir') . '/systatic.log');

        if (!$fileExists) {
            $this->filesystem->touch($this->config->getConfig('storageDir') . '/systatic.log');
        }

        $this->filesystem->appendToFile($this->config->getConfig('storageDir') . '/systatic.log', $message);

        return true;
    }
}
