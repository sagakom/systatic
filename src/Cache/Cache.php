<?php

namespace Thunderbird\Cache;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Thunderbird\Config\Config;

class Cache
{
    public function clearCache()
    {
        // Create instances
        $fileSystem = new Filesystem();
        $config = new Config();

        // Clear cache
        $fileSystem->remove(array('symlink', $config->getConfig('cacheDir'), '*.php'));    // Remove all files from cache
        $fileSystem->mkdir($config->getConfig('cacheDir'), 0700);  // Re-create cache directory
        $fileSystem->touch($config->getConfig('cacheDir') . '.gitkeep'); // Re-create cache directory gitkeep
    }
}