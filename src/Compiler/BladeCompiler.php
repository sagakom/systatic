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

    public function compile($array)
    {
        $page = $this->blade->make($array['view'], [
            'filename' => $array['filename'],
            'permalink' => $array['permalink'],
            'title' => $array['title'],
            'slug' => $array['slug'],
            'view' => $array['view'],
            'content' => $array['content'],
            'meta' => $array['meta'],

            'url' => $this->config->get('url') . $array['slug'] . '.html',
            'config' => ((object) $this->config->getArray()),
            'collections' => collect((new Collections())->fetch())
        ]);

        $name = '/' . $array['permalink'];

        if(startsWith($array['permalink'], '/')) {
            $name = $array['permalink'];
        }

        if(array_key_exists('filetype', $array['meta'])) {
            str_replace('.html', '.' . $array['meta']['filetype'], $name);
        }

        file_write_contents($this->config->get('locations.output') . $name, $page);

        $this->cache->clearCache();

        return true;
    }
}
