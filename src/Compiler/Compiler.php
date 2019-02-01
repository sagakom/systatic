<?php

namespace Thunderbird\Compiler;

use Pagerange\Markdown\MetaParsedown;
use Jenssegers\Blade\Blade;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Thunderbird\Config\Config;
use Thunderbird\Cache\Cache;

class Compiler 
{

    public function compile($file)
    {
        // Create instances
        $config = new Config();
        $cache = new Cache();
        $parsedown = new MetaParsedown();
        $blade = new Blade($config->getConfig('viewsDir'), $config->getConfig('cacheDir'));
        $fileSystem = new Filesystem();

        // Basic file information
        $slug = basename($file, '.md');
        $file = file_get_contents($file);

        // Parse markdown
        $markdown = $parsedown->text($file);

        // Parse Front Matter
        $matter = $parsedown->meta($file);

        // Decide on the template to use
        $views = $config->getConfig('viewsDir');

        if(array_key_exists('template', $matter)) {
            if($fileSystem->exists($views . '/' . $matter['template'] . '.blade.php')) {
                // Matter template
                $template = $matter['template'];
            }
        } elseif($fileSystem->exists($views . '/' . $slug . '.blade.php')) {
            $template = $slug;
        } else {
            $template = 'index';
        }

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
        $blade->compiler()->directive('siteName', function() use($config) 
        {
            return $config->getConfig('siteName');
        });

        // Blade: Site URL
        $blade->compiler()->directive('siteUrl', function() use($config) 
        {
            return $config->getConfig('siteUrl');
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