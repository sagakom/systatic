<?php

namespace Thunderbird\Compiler;

use Damcclean\Markdown\MetaParsedown;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Thunderbird\Config\Config;
use Thunderbird\Cache\Cache;
use Thunderbird\Compiler\BladeCompiler;

class Compiler 
{
    public function __construct()
    {
        $this->config = new Config();
        $this->cache = new Cache();
        $this->parsedown = new MetaParsedown();
        $this->blade = new BladeCompiler();
        $this->filesystem = new Filesystem();
    }

    public function markdown($file)
    {
        // Basic file information
        $slug = basename($file, '.md');
        $file = file_get_contents($file);

        // Parse markdown
        $markdown = $this->parsedown->text($file);

        // Parse Front Matter
        $matter = $this->parsedown->meta($file);

        // Set a title - either from the title in the front matter or just set nothing as the title
        $title = '';
        if(array_key_exists('title', $matter)) {
            $title = $matter['title'];
        }

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

        // Compile 
        $this->blade->compile([
            'template' => $template,
            'slug' => $slug,
            'title' => $title,
            'content' => $markdown,
            'matter' => $matter
        ]);

        return true;
    }

    public function html($file)
    {
        // Basic file information
        $slug = basename($file, '.html');
        $file = file_get_contents($file);

        // Get the content of the file
        $content = $file;

        // Set the title
        $title = '';

        // Decide on a template
        $template = 'index';

        if($this->filesystem->exists($this->config->getConfig('viewsDir') . '/' . $slug . '.blade.php')) {
            $template = $slug;
        }

        // Compile 
        $this->blade->compile([
            'template' => $template,
            'slug' => $slug,
            'title' => $title,
            'content' => $content,
            'matter' => [
                'title' => $title
            ]
        ]);

        return true;
    }
}