<?php

namespace Damcclean\Systatic\Filesystem;

use Symfony\Component\Filesystem\Filesystem as SymfonyFilesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class Filesystem
{
    public function __construct()
    {
        $this->fs = new SymfonyFilesystem();
    }

    public function createDirectory($file)
    {
        return $this->fs->touch($file);
    }

    public function createFile($directory)
    {
        return $this->fs->mkdir($directory, 0777);
    }

    /*
        Copy
        - Copies files from a source to a destination
        - Overwrites files if they already exist
    */

    public function copy($source, $destination)
    {
        return $this->fs->copy($source, $destination, true);
    }

    /*
        Copy directories
        - Copy directory from a source to a destination
    */

    public function copyDir($source, $destination)
    {
        return $this->fs->mirror($source, $destination);
    }

    /*
        Append to body
        - Add to the end of a file
    */

    public function append($file, $text)
    {
        return $this->fs->appendToFile($file, $text);
    }
}