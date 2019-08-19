<?php

namespace Damcclean\Systatic\Compiler;

use Damcclean\Systatic\Config\Config;

class Compiler
{
    public function __construct()
    {
        $this->config = new Config();
        $this->compilerStore = new \Damcclean\Systatic\Plugins\Compiler();
    }

    public function compile(array $entry)
    {
        $compilers = $this->compilerStore->get();

        foreach ($compilers as $compiler) {
            foreach($compiler['extensions'] as $extension) {
                if (file_exists($this->config->get('locations.views').'/'.$entry['view'].$extension)) {
                    return $compiler['class']()->compile($entry);
                }
            }
        }

        return (new BladeCompiler())->compile($entry);
    }
}
