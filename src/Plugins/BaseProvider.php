<?php

namespace Damcclean\Systatic\Plugins;

class BaseProvider
{
    public function __construct()
    {
        $this->plugins = new Plugins();
    }

    public function boot()
    {
        // WIP
    }

    public function registerConsole($consoleClass)
    {
        $this->plugins->setupConsole($consoleClass);
    }

    public function registerCompiler($c)
    {
        // WIP
    }
}