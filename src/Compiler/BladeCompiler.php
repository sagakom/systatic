<?php

namespace Damcclean\Systatic\Compiler;

use Jenssegers\Blade\Blade;
use Tightenco\Collect\Support\Collection;
use Damcclean\Systatic\Cache\Cache;
use Damcclean\Systatic\Config\Config;
use Damcclean\Systatic\Collections\Collections;

class BladeCompiler
{
    public function __construct()
    {
        $this->cache = new Cache();
        $this->config = new Config();
        $this->blade = new Blade($this->config->get('locations.views'), $this->config->get('locations.storage') . '/cache');
    }

    /*
        Compile with Laravel Blade
    */

    public function compile($array)
    {
        $page = $this->blade->make($array['view'], [
            'filename' => $array['filename'],
            'title' => $array['title'],
            'slug' => $array['slug'],
            'view' => $array['view'],
            'content' => $array['content'],
            'meta' => $array['meta'],
            'type' => $array['type'],

            'config' => $this->config->getArray(),
            'collection' => collect((new Collections())->fetch())
        ]);

        file_put_contents($this->config->get('locations.output') . '/' . $array['slug'] . '.html', $page);

        $this->cache->clearCache();

        return true;
    }
}
