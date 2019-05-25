<?php

namespace Damcclean\Systatic\Collections;

use Symfony\Component\Filesystem\Filesystem;

use Damcclean\Markdown\MetaParsedown;
use Damcclean\Systatic\Config\Config;

class Collections
{
    public function __construct()
    {
        $this->config = new Config();
        $this->parsedown = new MetaParsedown();
        $this->store = [];

        $this->filesystem = new Filesystem();
    }

    /*
        Collect Markdown and HTML files to the store
    */

    public function collect()
    {
        $markdown = [];
        $html = [];

        $markdown = array_merge(glob($this->config->getConfig('contentDir') . '/*.md', GLOB_BRACE), $markdown);
        $markdown = array_merge(glob($this->config->getConfig('contentDir') . '/*/*.md', GLOB_BRACE), $markdown);
        $markdown = array_merge(glob($this->config->getConfig('contentDir') . '/*.markdown', GLOB_BRACE), $markdown);
        $markdown = array_merge(glob($this->config->getConfig('contentDir') . '/*/*.markdown', GLOB_BRACE), $markdown);

        $html = array_merge(glob($this->config->getConfig('contentDir') . '/*.html', GLOB_BRACE), $html);
        $html = array_merge(glob($this->config->getConfig('contentDir') . '/*/*.html', GLOB_BRACE), $html);

        foreach($markdown as $file) {
            $this->markdown($file);
        }

        foreach($html as $file) {
            $this->html($file);
        }

        $this->save($this->store);

        // Go through everything in the collections and compile html output for them

        return true;
    }

    /*
        Save to store
    */

    public function save($store)
    {
        file_put_contents($this->config->getConfig('storageDir') . '/store.json', json_encode($store));
        return true;
    }

    /*  
        Fetch from store
    */

    public function fetch()
    {
        return json_decode(file_get_contents($this->config->getConfig('storageDir') . '/store.json'));
    }

    /*
        Fetch from store (As JSON)
    */

    public function fetchAsJson()
    {
        return file_get_contents($this->config->getConfig('storageDir') . '/store.json');
    }

    /*
        Get Markdown file information
    */

    public function markdown($file)
    {
        $filename = $file;
        $contents = file_get_contents($file);

        if(strpos($filename, '.md')) {
            $slug = basename($filename, '.md');
        } elseif(strpos($filename, '.markdown')) {
            $slug = basename($filename, '.markdown');
        }

        $title = $slug;
        $view = 'index';

        $markdown = $this->parsedown->text($contents);
        $frontMatter = $this->parsedown->meta($contents);

        if(array_key_exists('title', $frontMatter)) {
            $title = $frontMatter['title'];
        }

        if(array_key_exists('slug', $frontMatter)) {
            $slug = $frontMatter['slug'];

            if(!array_key_exists('title', $frontMatter)) {
                $title = $slug;
            }
        }

        if(array_key_exists('view', $frontMatter)) {
            if(file_exists($this->config->getConfig('viewsDir') . '/' . $frontMatter['view'] . '.blade.php')) {
                $view = $frontMatter['view'];
            } elseif(file_exists($this->config->getConfig('viewsDir') . '/' . str_replace('.', '/', $frontMatter['view']) . '.blade.php')) {
                $view = str_replace('.', '/', $frontMatter['view']);
            }
        } elseif($slug !== 'index') {
            if(file_exists($this->config->getConfig('viewsDir') . '/' . $slug . '.blade.php')) {
                $view = $slug;
            }
        }

        $entry = [
            'filename' => $filename,
            'title' => $title,
            'slug' => $slug,
            'view' => $view,
            'content' => $markdown,
            'meta' => $frontMatter
        ];

        array_push($this->store, $entry);

        return $entry;
    }

    /*
        Get HTML file information
    */

    public function html($file)
    {
        $filename = $file;
        $contents = file_get_contents($file);

        if(strpos($filename, '.html')) {
            $slug = basename($filename, '.html');
        }

        if(file_exists($this->config->getConfig('viewsDir') . '/' . $slug . '.blade.php')) {
            $view = $slug;
        }

        $title = $slug;
        $view = 'index';

        if(file_exists($this->config->getConfig('viewsDir') . '/' . $slug . '.blade.php')) {
            $view = $slug;
        }

        $entry = [
            'filename' => $filename,
            'title' => $title,
            'slug' => $slug,
            'view' => $view,
            'content' => $contents,
            'meta' => []
        ];

        array_push($this->store, $entry);

        return $entry;
    }
}