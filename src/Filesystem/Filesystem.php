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

    public function createFile($file)
    {
        return $this->fs->touch($file);
    }

    public function createDirectory($directory)
    {
        return $this->fs->mkdir($directory, 0777);
    }

    public function copy($source, $destination)
    {
        return $this->fs->copy($source, $destination, true);
    }

    public function copyDir($source, $destination)
    {
        return $this->fs->mirror($source, $destination);
    }

    public function append($file, $text)
    {
        return $this->fs->appendToFile($file, $text);
    }
}