<?php

namespace Damcclean\Systatic\Cache;

use Damcclean\Systatic\Config\Config;
use Illuminate\Filesystem\Filesystem;

class Cache
{
    public function __construct()
    {
        $this->config = new Config();
        $this->filesystem = new Filesystem();
    }

    public function clearEverything()
    {
        $this->clearViewCache();
        $this->clearStoreCache();
    }

    public function clearViewCache()
    {
        $viewCacheFiles = glob(
            $this->config->get('locations.storage') . '/cache/*.php',
            GLOB_BRACE
        );

        foreach ($viewCacheFiles as $file) {
            $this->filesystem->delete($file);
        }
    }

    public function clearStoreCache()
    {
        $storeFiles = glob(
            $this->config->get('locations.storage') . '/*.json',
            GLOB_BRACE
        );

        foreach ($storeFiles as $file) {
            $this->filesystem->delete($file);
        }
    }

    public function clearSiteOutput()
    {
        $files = [];
        $files = array_merge(glob($this->config->get('locations.output') . '/*.html', GLOB_BRACE), $files);
        $files = array_merge(glob($this->config->get('locations.output') . '/*/*.html', GLOB_BRACE), $files);
        $files = array_merge(glob($this->config->get('locations.output') . '/*/*/*.html', GLOB_BRACE), $files);
        $files = array_merge(glob($this->config->get('locations.output') . '/*/*/*/*.html', GLOB_BRACE), $files);

        foreach ($files as $file) {
            if (array_key_exists('whitelist', $this->config->getArray())) {
                $whitelist = $this->config->getArray()['whitelist'];

                foreach ($whitelist as $item) {
                    if (! $file === $item) {
                        $this->filesystem->delete($file);
                    }
                }
            } else {
                $this->filesystem->delete($file);
            }
        }
    }
}
