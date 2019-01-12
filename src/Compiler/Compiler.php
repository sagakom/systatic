<?php

namespace Thunderbird\Compiler;

use Parsedown;
use Jenssegers\Blade\Blade;
use Thunderbird\Config\Config;
use Thunderbird\Cache\Cache;

class Compiler 
{

    public function compile($file, $template) 
    {
        // Create instances
        $config = new Config();
        $cache = new Cache();
        $parsedown = new Parsedown();
        $blade = new Blade($config->getEnv('VIEWS_DIR'), './local/cache');

        // Basic file information
        $slug = basename($file, '.md'); // Slug
        $file = file_get_contents($file);   // File contents

        // Parse markdown
        $markdown = $parsedown->text($file);    // Markdown as HTML

        // Blade templating
        $page = $blade->make($template);

        // Blade: Content
        $blade->compiler()->directive('content', function() use($markdown) 
        {
            return $markdown;
        });

        // Blade: Site Name
        $siteName = $config->getConfig('SITE_NAME');
        $blade->compiler()->directive('siteName', function() use($siteName) 
        {
            return $siteName;
        });

        // Blade: Site URL
        $siteUrl = $config->getConfig('SITE_URL');
        $blade->compiler()->directive('siteUrl', function() use($siteUrl) 
        {
            return $siteUrl;
        });

        // Output the final blade template
        file_put_contents($config->getEnv('OUTPUT_DIR') . '/' . $slug . '.html', $page);

        // Clear cache
        $cache->clearCache();

    }

}