<?php

namespace Damcclean\Systatic\Console;

use Damcclean\Systatic\Console\Commands\BuildCommand;
use Damcclean\Systatic\Console\Commands\ClearCacheCommand;
use Damcclean\Systatic\Console\Commands\ClearSiteCommand;
use Damcclean\Systatic\Console\Commands\DeployCommand;
use Damcclean\Systatic\Console\Commands\GhostImportCommand;
use Damcclean\Systatic\Console\Commands\InitCommand;
use Damcclean\Systatic\Console\Commands\JekyllImportCommand;
use Damcclean\Systatic\Console\Commands\ServeCommand;
use Damcclean\Systatic\Console\Commands\WordPressImportCommand;
use Illuminate\Events\Dispatcher;
use Illuminate\Console\Application;
use Illuminate\Container\Container;
use Damcclean\Systatic\Plugins\Plugins;

class Kernel
{
    public function __construct()
    {
        $this->plugins = new Plugins();
        $this->container = new Container();
        $this->events = new Dispatcher($this->container);
    }

    public function commands()
    {
        $application = new Application($this->container, $this->events, 'Version 2');
        $application->setName('Systatic');

        $application->add(new InitCommand());
        $application->add(new BuildCommand());
        $application->add(new ClearSiteCommand());
        $application->add(new ClearCacheCommand());
        $application->add(new WordPressImportCommand());
        $application->add(new JekyllImportCommand());
        $application->add(new GhostImportCommand());
        $application->add(new DeployCommand());
        $application->add(new ServeCommand());



        //$pluginCommands = $this->plugins->commands();

//        foreach ($pluginCommands as $command) {
//            $application->add(new $command());
//        }

        $application->run();
    }
}
