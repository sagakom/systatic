<?php

namespace Damcclean\Systatic\Plugins;

use Damcclean\Systatic\Store;

class Plugins extends Store
{
    public $name = 'plugins';
    protected $pluginData = [];

    public function __construct()
    {
        parent::__construct();

        $this->consoleStore = new Console();
        $this->compilerStore = new Compiler();
    }

    public function find()
    {
        if (array_key_exists('plugins', $this->config->getArray())) {
            foreach ($this->config->getArray()['plugins'] as $plugin) {
                $p = new $plugin();

                array_push($this->pluginData, $plugin);

                $p->boot();
            }
        }

        $this->store($this->pluginData);
    }

    public function setupConsole(string $consoleClass)
    {
        $commands = new $consoleClass();

        return $this->consoleStore->add(
            array_merge(
                $this->consoleStore->get(),
                $commands()
            )
        );
    }

    public function setupCompiler(string $compilerClass)
    {
        $compiler = new $compilerClass();

        $data = [
            'class' => $compilerClass,
            'extensions' => $compiler->extensions,
        ];

        return $this->compilerStore->add(
            array_merge(
                $this->compilerStore->get(),
                $data
            )
        );
    }
}
