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
        //
    }

    public function registerConsole($c)
    {
        $this->plugins->setupConsole($c);
    }

    public function registerCompiler($c)
    {

    }
}