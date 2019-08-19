<?php

namespace Damcclean\Systatic\Compiler;

use Jenssegers\Blade\Blade;
use Damcclean\Systatic\Config\Config;

class BladeCompiler
{
    public function __construct()
    {
        $this->page = new Page();
        $this->config = new Config();
        $this->blade = new Blade($this->config->get('locations.views'), $this->config->get('locations.storage') . '/cache');
    }

    public function compile(array $data)
    {
        $page = $this->page->process($data);
        $view = $this->blade->make($data['view'], $page);

        return (bool) file_write_contents($this->config->get('locations.output') . $page['output_filename'], $view);
    }
}
