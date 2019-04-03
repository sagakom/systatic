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

    public function log($message)
    {
        // Check if the log file exists
        $fileExists = $this->filesystem->exists($this->config->getConfig('storageDir') . '/systatic.log');

        // If the file does exist do nothing but if not, create the log file
        if($fileExists) {
            // Do nothing
        } else {
            $this->filesystem->touch($this->config->getConfig('storageDir') . '/systatic.log');
        }

        // Write to the log file
        $this->filesystem->appendToFile($this->config->getConfig('storageDir') . '/systatic.log', $message);

        return true;
    }
}