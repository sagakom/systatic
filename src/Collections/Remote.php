<?php

namespace Damcclean\Systatic\Collections;

use Damcclean\Systatic\Config\Config;

class Remote
{
    protected $entries = [];

    public function __construct()
    {
        $this->config = new Config();
    }

    public function process(array $collection)
    {
        $items = $collection['remote']();

        foreach ($items as $item) {
            $entry = $this->parse($item, $collection);
            array_push($this->entries, $entry);
        }

        return $this->entries;
    }

    public function parse(array $entry, array $collection)
    {
        $filename = $entry['slug'];
        $lastUpdated = null;
        $view = 'index';
        $content = '';
        $slug = uniqid();
        $title = '';

        if (array_key_exists('title', $entry)) {
            $title = $entry['title'];
        }

        if (array_key_exists('last_updated', $entry)) {
            $lastUpdated = $entry['last_updated'];
        }

        if (array_key_exists('slug', $entry)) {
            $slug = $entry['slug'];

            if (file_exists($this->config->get('locations.views') . '/' . $slug . '.blade.php')) {
                $view = $entry['slug'];
            }
        }

        if (array_key_exists('view', $entry)) {
            if (file_exists($this->config->get('locations.views') . '/' . $view . '.blade.php')) {
                $view = $entry['view'];
            }
        }

        if (array_key_exists('content', $entry)) {
            $content = $entry['content'];
        }

        if (endsWith($collection['permalink'], '/')) {
            $permalink = $collection['permalink'] . $slug . '/index.html';
        } else {
            $permalink = $collection['permalink'] . '/' . $slug . '/index.html';
        }

        $newEntry = [
            'filename' => $filename,
            'permalink' => $permalink,
            'title' => $title,
            'slug' => $slug,
            'view' => $view,
            'content' => $content,
            'meta' => $entry,
            'last_updated' => $lastUpdated,
        ];

        return $newEntry;
    }
}
