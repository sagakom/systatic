<?php

namespace Damcclean\Systatic\Cache;

use Damcclean\Systatic\Config\Config;
use Damcclean\Systatic\Filesystem\Filesystem;

class Cache
{
    public function __construct()
    {
        $this->config = new Config();
        $this->filesystem = new Filesystem();
    }

    public function clearEverything()
    {
//        $this->clearViewCache();
//        $this->clearStoreCache();
    }

    public function clearViewCache()
    {
//        $viewCacheFiles = glob(
//            $this->config->get('locations.storage') . '/cache/*.php',
//            GLOB_BRACE
//        );
//
//        foreach($viewCacheFiles as $file) {
//            $this->filesystem->delete($file);
//        }
    }

    public function clearStoreCache()
    {
//        $storeFiles = glob(
//            $this->config->get('locations.storage') . '/*.json',
//            GLOB_BRACE
//        );
//
//        foreach($storeFiles as $file) {
//            $this->filesystem->delete($file);
//        }
    }
}
