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
        Compile with given information
    */

    public function compile($array)
    {
        // Fetches parameter array
        $view = $array['view'];
        $slug = $array['slug'];
        $title = $array['title'];
        $content = $array['content'];
        $matter = $array['matter'];

        // Sends variables to Blade view
        $page = $this->blade->make($view, [
            'page' => $array,
            'title' => $title,
            'slug' => $slug,
            'url' => $this->config->getConfig('siteUrl') . '/' . $slug,
            'content' => $content,
            'matter' => $matter,
            'site' => [
                'name' => $this->config->getConfig('siteName'),
                'url' => $this->config->getConfig('siteUrl')
            ],
            'config' => $this->config->getConfigArray()
        ]);

        file_put_contents($this->config->getConfig('outputDir') . '/' . $slug . '.html', $page);

        $this->cache->clearCache();
    }
}
