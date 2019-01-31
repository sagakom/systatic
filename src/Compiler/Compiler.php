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
        $blade = new Blade($config->getConfig('viewsDir'), $config->getConfig('cacheDir'));

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
        $siteName = $config->getConfig('siteName');
        $blade->compiler()->directive('siteName', function() use($siteName) 
        {
            return $siteName;
        });

        // Blade: Site URL
        $siteUrl = $config->getConfig('siteUrl');
        $blade->compiler()->directive('siteUrl', function() use($siteUrl) 
        {
            return $siteUrl;
        });

        // Blade: Config Value
        $blade->compiler()->directive('config', function($setting) use($config) 
        {
            return $config->getConfig($setting);
        });

        // Blade: Env Value
        $blade->compiler()->directive('env', function($setting) use($config) 
        {
            return $config->getEnv($setting);
        });

        // Output the final blade template
        file_put_contents($config->getConfig('outputDir') . '/' . $slug . '.html', $page);

        // Clear cache
        $cache->clearCache();

    }

}