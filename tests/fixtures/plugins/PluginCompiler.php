<?php

namespace Tests\fixtures\plugins;

class PluginCompiler
{
    public $extensions = [
        '.html'
    ];

    public function compile()
    {
        return true;
    }
}