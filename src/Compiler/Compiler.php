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

    /*
        - Decide which templating driver to use
        - Then send the entry to the compiler
    */

    public function compile($entry)
    {
        if($this->config->getConfig('compiler') === "blade") {
            $compiler = 'blade';
            $this->blade->compile($entry);
        } else {
            $compiler = 'blade';
            $this->blade->compile($entry);
        }
    }
}