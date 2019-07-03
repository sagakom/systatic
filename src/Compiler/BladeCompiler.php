<?php

namespace Damcclean\Systatic\Compiler;

use Jenssegers\Blade\Blade;
use Tightenco\Collect\Support\Collection;
use Damcclean\Systatic\Cache\Cache;
use Damcclean\Systatic\Config\Config;
use Damcclean\Systatic\Filesystem\Filesystem;
use Damcclean\Systatic\Collections\Collections;

class BladeCompiler
{
    public function __construct()
    {
        $this->cache = new Cache();
        $this->config = new Config();
        $this->filesystem = new Filesystem();
        $this->blade = new Blade($this->config->get('locations.views'), $this->config->get('locations.storage') . '/cache');
    }

    public function compile($data)
    {
        $page = [
            'url' => $this->config->get('url') . $data['slug'] . '.html',
            'filename' => $data['filename'],
            'permalink' => $data['permalink'],

            'title' => $data['title'],
            'slug' => $data['slug'],
            'view' => $data['view'],
            'content' => $data['content'],
            'meta' => $data['meta'],

            'config' => $this->config->getArray(),
        ];

        foreach((new Collections())->fetch() as $collection) {
            $page["{$collection['key']}"] = convert_to_object($collection['items']);
        }

        $view = $this->blade->make($data['view'], $page);

        $name = '/' . $data['permalink'];

        if(startsWith($data['permalink'], '/')) {
            $name = $data['permalink'];
        }

        if(array_key_exists('filetype', $data['meta'])) {
            str_replace('.html', '.' . $data['meta']['filetype'], $name);
        }

        file_write_contents($this->config->get('locations.output') . $name, $view);

        $this->cache->clearCache();

        return true;
    }
}
