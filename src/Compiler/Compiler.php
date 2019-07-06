<?php

namespace Damcclean\Systatic\Compiler;

use Damcclean\Systatic\Config\Config;
use Damcclean\Systatic\Compiler\BladeCompiler;

class Compiler
{
    public function __construct()
    {
        $this->config = new Config();
        $this->blade = new BladeCompiler();
    }

    public function compile($entry)
    {
        $compiler = 'blade';

        if($compiler === 'blade') {
            $this->blade->compile($entry);
        }
    }
}