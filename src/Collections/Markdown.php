<?php

namespace Damcclean\Systatic\Collections;

use Damcclean\Systatic\Parsers\Yaml;
use Damcclean\Systatic\Config\Config;
use Damcclean\Systatic\Plugins\Compiler;
use Damcclean\Systatic\Parsers\ParsedownExtra;

class Markdown
{
    public function __construct()
    {
        $this->config = new Config();
        $this->markdown = new ParsedownExtra();
        $this->yaml = new Yaml();
        $this->compiler = new Compiler();
    }

    public function parse(string $file, array $collection)
    {
        $filename = $file;
        $contents = file_get_contents($file);

        $lastUpdated = filemtime($file);

        if ($lastUpdated === false) {
            $lastUpdated = null;
        }

        if (strpos($filename, '.md')) {
            $slug = basename($filename, '.md');
        } elseif (strpos($filename, '.markdown')) {
            $slug = basename($filename, '.markdown');
        }

        $title = $slug;
        $view = 'index';

        $markdown = $this->markdown->parse($contents);
        $frontMatter = $this->yaml->parse($contents);

        if (array_key_exists('title', $frontMatter)) {
            $title = $frontMatter['title'];
        }

        if (array_key_exists('slug', $frontMatter)) {
            $slug = $frontMatter['slug'];

            if (! array_key_exists('title', $frontMatter)) {
                $title = $slug;
            }
        }

        if (array_key_exists('view', $frontMatter)) {
            foreach ($this->compiler->getExtensions() as $extension) {
                if (file_exists($this->config->get('locations.views') . '/' . $frontMatter['view'] . $extension)) {
                    $view = $frontMatter['view'];
                } elseif (file_exists($this->config->get('locations.views') . '/' . str_replace('.', '/', $frontMatter['view']) . $extension)) {
                    $view = str_replace('.', '/', $frontMatter['view']);
                }
            }
        } elseif (array_key_exists('view', $collection)) {
            foreach ($this->compiler->getExtensions() as $extension) {
                if (file_exists($this->config->get('locations.views') . '/' . $collection['view'] . $extension)) {
                    $view = $collection['view'];
                }
            }
        } elseif ($slug !== 'index') {
            foreach ($this->compiler->getExtensions() as $extension) {
                if (file_exists($this->config->get('locations.views') . '/' . $slug . $extension)) {
                    $view = $slug;
                }
            }
        }

        if (endsWith($collection['permalink'], '/') != false) {
            $permalink = $collection['permalink'] . $slug;
        } else {
            $permalink = $collection['permalink'] . '/' . $slug;
        }

        if ($slug != 'index') {
            $permalink = $permalink . '/index.html';
        } else {
            $permalink = $permalink . '.html';
        }

        $entry = [
            'filename' => $filename,
            'permalink' => $permalink,
            'title' => $title,
            'slug' => $slug,
            'view' => $view,
            'content' => $markdown,
            'meta' => $frontMatter,
            'last_updated' => $lastUpdated,
        ];

        return $entry;
    }
}
