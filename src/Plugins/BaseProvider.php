<?php

namespace Damcclean\Systatic\Plugins;

class BaseProvider
{
    public function __construct()
    {
        $this->plugins = new Plugins();
    }

    public function registerConsole(string $consoleClass)
    {
        $this->plugins->setupConsole($consoleClass);
    }

    public function registerCompiler(string $compilerClass)
    {
        $this->plugins->setupCompiler($compilerClass);
    }
}