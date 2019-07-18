<?php

namespace Damcclean\Systatic\Filesystem;

use Symfony\Component\Filesystem\Filesystem as SymfonyFilesystem;

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

    public function copyDirectory($source, $destination)
    {
        return $this->fs->mirror($source, $destination);
    }

    public function append($file, $text)
    {
        return $this->fs->appendToFile($file, $text);
    }

    public function dump($file, $text)
    {
        return $this->fs->dumpFile($file, $text);
    }

    public function rename($old, $new)
    {
        return $this->fs->rename($old, $new);
    }

    public function delete($file)
    {
        return $this->fs->remove(['symlink', $file, 'filesystem.log']);
    }
}
