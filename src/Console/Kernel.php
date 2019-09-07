<?php

namespace Damcclean\Systatic\Console;

use Illuminate\Events\Dispatcher;
use Illuminate\Console\Application;
use Illuminate\Container\Container;
use Damcclean\Systatic\Plugins\Console;
use Damcclean\Systatic\Console\Commands\InitCommand;
use Damcclean\Systatic\Console\Commands\BuildCommand;
use Damcclean\Systatic\Console\Commands\ServeCommand;
use Damcclean\Systatic\Console\Commands\DeployCommand;
use Damcclean\Systatic\Console\Commands\ClearSiteCommand;
use Damcclean\Systatic\Console\Commands\ClearCacheCommand;
use Damcclean\Systatic\Console\Commands\GhostImportCommand;
use Damcclean\Systatic\Console\Commands\JekyllImportCommand;
use Damcclean\Systatic\Console\Commands\WordPressImportCommand;

class Kernel
{
    public function __construct()
    {
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

        $commands = (new Console())->get();

        foreach ($commands as $command) {
            $application->add(new $command());
        }

        $application->run();
    }
}
