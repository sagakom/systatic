<?php

namespace Thunderbird\Cache;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class Cache
{
    public function clearCache()
    {
        // Create instances
        $fileSystem = new Filesystem();

        // Clear cache
        $fileSystem->remove(array('symlink', './local/cache', '*.php'));    // Remove all files from cache
        $fileSystem->mkdir('./local/cache', 0700);  // Re-create cache directory
        $fileSystem->touch('./local/cache/.gitkeep'); // Re-create cache directory gitkeep
    }
}