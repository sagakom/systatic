<?php

namespace Thunderbird\Logging;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class Logging
{
    public function __construct()
    {
        $this->filesystem = new Filesystem();
    }

    public function log($message)
    {
        // Check if the log file exists
        $fileExists = $this->filesystem->exists('./local/thunderbird.log');

        // If the file does exist do nothing but if not, create the log file
        if($fileExists) {
            // Do nothing
        } else {
            $this->filesystem->touch('./local/thunderbird.log');
        }

        // Write to the log file
        $this->filesystem->appendToFile('./local/thunderbird.log', $message);

        return true;
    }
}