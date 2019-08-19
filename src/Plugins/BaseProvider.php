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
        return $this->plugins->setupConsole($consoleClass);
    }

    public function registerCompiler(string $compilerClass)
    {
        return $this->plugins->setupCompiler($compilerClass);
    }
}