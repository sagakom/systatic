<?php

namespace Damcclean\Systatic\Cache;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Damcclean\Systatic\Config\Config;

class Cache
{
    public function __construct()
    {
        $this->filesystem = new Filesystem();
        $this->config = new Config();
    }

    /*
        Clear the site cache
    */

    public function clearCache()
    {
        $this->filesystem->remove(array('symlink', $this->config->getConfig('locations.storage'), '/cache/*.php'));    // Remove all files from cache
        $this->filesystem->mkdir($this->config->getConfig('locations.storage') . '/cache', 0700);  // Re-create cache directory
        $this->filesystem->touch($this->config->getConfig('locations.storage') . '/cache/.gitkeep'); // Re-create cache directory gitkeep
    }
}
