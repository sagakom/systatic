<?php

namespace Damcclean\Systatic\Compiler;

use Damcclean\Markdown\MetaParsedown;
use Damcclean\Systatic\Config\Config;
use Damcclean\Systatic\Cache\Cache;
use Damcclean\Systatic\Compiler\BladeCompiler;

class Compiler
{
    public function __construct()
    {
        $this->config = new Config();
        $this->cache = new Cache();
        $this->parsedown = new MetaParsedown();
        $this->blade = new BladeCompiler();
    }

    /*
        Compile a Markdown file
    */

    public function markdown($file)
    {
        // Slug
        if (strpos($file, '.md')) {
            $slug = basename($file, '.md');
        } elseif (strpos($file, '.markdown')) {
            $slug = basename($file, '.markdown');
        }

        // File contents
        $file = file_get_contents($file);

        // Parse markdown
        $markdown = $this->parsedown->text($file);

        // Parse Front Matter
        $matter = $this->parsedown->meta($file);

        // Set a title - either from the title in the front matter or just set nothing as the title
        $title = $slug;
        if (array_key_exists('title', $matter)) {
            $title = $matter['title'];
        }

        // If page has different slug setup in front matter
        if (array_key_exists('slug', $matter)) {
            $slug = $matter['slug'];
            $title = $slug;
        }

        // Set view
        $view = 'index';

        if (array_key_exists('view', $matter)) {
            if (file_exists($this->config->getConfig('viewsDir') . '/' . $matter['view'] . '.blade.php')) {
                // Front matter view
                $view = $matter['view'];

                // If it contains '.' replace it with '/'
                if (strpos($view, '.') !== false) {
                    $view = str_replace('.', '/', $view);
                }
            }
        } elseif (file_exists($this->config->getConfig('viewsDir') . '/' . $slug . '.blade.php')) {
            $view = $slug;
        }

        // Compile
        $this->blade->compile([
            'view' => $view,
            'slug' => $slug,
            'title' => $title,
            'content' => $markdown,
            'matter' => $matter
        ]);

        return true;
    }

    /*
        Compile a HTML file
    */

    public function html($file)
    {
        $slug = basename($file, '.html');
        $file = file_get_contents($file);

        $title = '';
        $content = $file;
        $view = 'index';

        if (file_exists($this->config->getConfig('viewsDir') . '/' . $slug . '.blade.php')) {
            $view = $slug;
        }

        $this->blade->compile([
            'view' => $view,
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
