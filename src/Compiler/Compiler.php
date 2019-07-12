<?php

namespace Damcclean\Systatic\Compiler;

use Damcclean\Systatic\Config\Config;
use Damcclean\Systatic\Plugins\Plugins;

class Compiler
{
    public function __construct()
    {
        $this->config = new Config();
        $this->plugins = new Plugins();
        $this->blade = new BladeCompiler();
    }

    public function compile($entry)
    {
        $compilers = [];
        $compilers['blade'] = '\Damcclean\Systatic\Compiler\BladeCompiler';

        $compiler = 'blade';

        if($this->config->get('compiler')) {
            $compiler = $this->config->get('compiler');
        }

        foreach($compilers as $key => $value) {
            if($key == $compiler) {
                dd($value);

                $p = new $value();
                $p->compile();
            }
        }
    }
}