<?php

namespace Damcclean\Systatic\Plugins;

use Damcclean\Systatic\Store;

class Compiler extends Store
{
    public $name = 'compiler';

    public function add(array $data)
    {
        $this->store($data);

        return $this->get();
    }

    public function getExtensions()
    {
        $extensions = [
            '.blade.php',
        ];

        $compilers = $this->get();

        foreach ($compilers as $compiler) {
            foreach ($compiler['extensions'] as $extension) {
                $extensions[] = $extension;
            }
        }

        return $extensions;
    }
}
