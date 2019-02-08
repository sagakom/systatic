<?php

namespace Thunderbird\Cache;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Thunderbird\Config\Config;

class Cache
{
    public function __construct()
    {
        $this->filesystem = new Filesystem();
        $this->config = new Config();
    }

    public function clearCache()
    {
        $this->filesystem->remove(array('symlink', $this->config->getConfig('cacheDir'), '*.php'));    // Remove all files from cache
        $this->filesystem->mkdir($this->config->getConfig('cacheDir'), 0700);  // Re-create cache directory
        $this->filesystem->touch($this->config->getConfig('cacheDir') . '/.gitkeep'); // Re-create cache directory gitkeep
    }
}