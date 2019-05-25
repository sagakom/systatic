<?php

namespace Damcclean\Systatic\Compiler;

use Damcclean\Systatic\Cache\Cache;
use Damcclean\Systatic\Config\Config;
use Jenssegers\Blade\Blade;

class BladeCompiler
{
    public function __construct()
    {
        $this->cache = new Cache();
        $this->config = new Config();
        $this->blade = new Blade($this->config->getConfig('viewsDir'), $this->config->getConfig('storageDir') . '/cache');
    }

    /*
        Compile with Laravel Blade
    */

    public function compile($array)
    {
        $page = $this->blade->make($array['view'], [
            'filename' => $array['filename'],
            'title' => $array['title'],
            'slug' => $array['slug'],
            'view' => $array['view'],
            'content' => $array['content'],
            'meta' => $array['meta'],
            'config' => $this->config->getConfigArray()
        ]);

        file_put_contents($this->config->getConfig('outputDir') . '/' . $array['slug'] . '.html', $page);

        $this->cache->clearCache();

        return true;
    }
}
