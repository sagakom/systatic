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

    public function compile($array)
    {
        // Get parameters
        $view = $array['view'];
        $slug = $array['slug'];
        $title = $array['title'];
        $content = $array['content'];
        $matter = $array['matter'];

        // Make the page with the chosen blade template and with all the variables
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

        // Setup a config variable for using it in blade
        $config = $this->config;

        // Directive: Env Value
        $this->blade->compiler()->directive('env', function($setting) use($config) 
        {
            return $config->getEnv($setting);
        });

        // Send blade putput to file
        file_put_contents($this->config->getConfig('outputDir') . '/' . $slug . '.html', $page);

        // Clear cache
        $this->cache->clearCache();

        return true;
    }
}