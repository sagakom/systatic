<?php

namespace Thunderbird\Compiler;

use Pagerange\Markdown\MetaParsedown;
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
        $parsedown = new MetaParsedown();
        $blade = new Blade($config->getEnv('VIEWS_DIR'), './local/cache');

        // Basic file information
        $slug = basename($file, '.md');
        $file = file_get_contents($file);

        // Parse markdown
        $markdown = $parsedown->text($file);

        // Parse Front Matter
        $matter = $parsedown->meta($file);

        // Blade templating
        $page = $blade->make($template);

        // Blade: Content
        $blade->compiler()->directive('content', function() use($markdown) 
        {
            return $markdown;
        });

        // Blade: Title
        $blade->compiler()->directive('title', function() use($matter)
        {
            return $matter['title'];
        });

        // Blade: Front Matter Variable
        $blade->compiler()->directive('matter', function($variable) use($matter)
        {
            return $matter[$variable];
        });

        // Blade: Site Name
        $siteName = $config->getEnv('SITE_NAME');
        $blade->compiler()->directive('siteName', function() use($siteName) 
        {
            return $siteName;
        });

        // Blade: Site URL
        $siteUrl = $config->getEnv('SITE_URL');
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