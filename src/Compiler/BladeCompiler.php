<?php

namespace Damcclean\Systatic\Compiler;

use Jenssegers\Blade\Blade;
use Damcclean\Systatic\Config\Config;
use Damcclean\Systatic\Filesystem\Filesystem;
use Damcclean\Systatic\Compiler\Page;

class BladeCompiler
{
    public function __construct()
    {
        $this->page = new Page();
        $this->config = new Config();
        $this->filesystem = new Filesystem();
        $this->blade = new Blade($this->config->get('locations.views'), $this->config->get('locations.storage') . '/cache');
    }

    public function compile($data)
    {
        $page = $this->page->process($data);

        $view = $this->blade->make($data['view'], $page);

        $name = '/' . $data['permalink'];

        if(startsWith($data['permalink'], '/')) {
            $name = $data['permalink'];
        }

        if(array_key_exists('filetype', $data['meta'])) {
            str_replace('.html', '.' . $data['meta']['filetype'], $name);
        }

        file_write_contents($this->config->get('locations.output') . $name, $view);

        return true;
    }
}
