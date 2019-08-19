<?php

namespace Damcclean\Systatic\Compiler;

use Damcclean\Systatic\Config\Config;

class Compiler
{
    public function __construct()
    {
        $this->config = new Config();
        $this->blade = new BladeCompiler();
    }

    public function compile(array $entry)
    {
        $compile = new BladeCompiler();
        $compile->compile($entry);
    }
}
