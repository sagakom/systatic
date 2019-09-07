<?php

namespace Damcclean\Systatic\Plugins;

use Damcclean\Systatic\Config\Config;
use Illuminate\Filesystem\Filesystem;

class BaseProvider
{
    public function __construct()
    {
        $this->plugins = new Plugins();
        $this->config = new Config();
    }

    public function registerConsole(string $consoleClass)
    {
        return $this->plugins->setupConsole($consoleClass);
    }

    public function registerCompiler(string $compilerClass)
    {
        return $this->plugins->setupCompiler($compilerClass);
    }

    public function publishViews(array $views)
    {
        foreach ($views as $path => $target) {
            (new Filesystem())->copy($path, $this->config->get('locations.views').'/'.$target);
        }
    }
}
