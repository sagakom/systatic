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
    public function __construct()
    {
        $this->config = new Config();
        $this->cache = new Cache();
        $this->parsedown = new MetaParsedown();
        $this->blade = new Blade($this->config->getConfig('viewsDir'), $this->config->getConfig('cacheDir'));
        $this->filesystem = new Filesystem();
    }

    public function compile($file)
    {
        // Basic file information
        $slug = basename($file, '.md');
        $file = file_get_contents($file);

        // Parse markdown
        $markdown = $this->parsedown->text($file);

        // Parse Front Matter
        $matter = $this->parsedown->meta($file);

        // If page has different slug setup in front matter
        if(array_key_exists('slug', $matter)) {
            $slug = $matter['slug'];
        }

        // Just set a template up first then detect if a different one is needed
        $template = 'index';

        if(array_key_exists('template', $matter)) {
            if($this->filesystem->exists($this->config->getConfig('viewsDir') . '/' . $matter['template'] . '.blade.php')) {
                // Matter template
                $template = $matter['template'];
            }
        } elseif($this->filesystem->exists($this->config->getConfig('viewsDir') . '/' . $slug . '.blade.php')) {
            $template = $slug;
        }

        // Make the page with the chosen blade template and with all the variables
        $page = $this->blade->make($template, [
            'title' => $matter['title'],
            'content' => $markdown
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
    }
}