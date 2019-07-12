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
        $this->blade = new BladeCompiler($entry);
    }
}