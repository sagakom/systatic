<?php

namespace Thunderbird\Compiler;

use Thunderbird\Cache\Cache;
use Thunderbird\Config\Config;
use Jenssegers\Blade\Blade;

class BladeCompiler
{
    public function __construct()
    {
        $this->cache = new Cache();
        $this->config = new Config();
        $this->blade = new Blade($this->config->getConfig('viewsDir'), $this->config->getConfig('cacheDir'));
    }

    public function compile($array)
    {
        // Get parameters
        $template = $array['template'];
        $slug = $array['slug'];
        $title = $array['title'];
        $content = $array['content'];
        $matter = $array['matter'];

        // Make the page with the chosen blade template and with all the variables
        $page = $this->blade->make($template, [
            'page' => $array,
            'title' => $title,
            'content' => $content,
            'matter' => $matter
        ]);

        // Setup a config variable for using it in blade
        $config = $this->config;

        // Directive: Front Matter Variable
        $this->blade->compiler()->directive('matter', function($variable) use($matter)
        {
            if (array_key_exists($variable, $matter)) {
                return $matter[$variable];
            }
        });

        // Directive: Site Name
        $this->blade->compiler()->directive('siteName', function() use($config) 
        {
            return $config->getConfig('siteName');
        });

        // Directive: Site URL
        $this->blade->compiler()->directive('siteUrl', function() use($config)
        {
            return $config->getConfig('siteUrl');
        });

        // Directive: Config Value
        $this->blade->compiler()->directive('config', function($setting) use($config) 
        {
            return $config->getConfig($setting);
        });

        // Directive: Env Value
        $this->blade->compiler()->directive('env', function($setting) use($config) 
        {
            return $config->getEnv($setting);
        });

        // Output the final blade template
        file_put_contents($this->config->getConfig('outputDir') . '/' . $slug . '.html', $page);

        // Clear cache
        $this->cache->clearCache();

        return true;
    }
}