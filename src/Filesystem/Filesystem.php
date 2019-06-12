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

    public function createDirectory()
    {
        //
    }

    public function createFile()
    {
        //
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
}