<?php

namespace Damcclean\Systatic\Commands;

use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Console\Application;

class Commands
{
    public function __construct()
    {
        $this->container = new Container();
        $this->events = new Dispatcher($this->container);
    }

    /*
        Load application comands
        - Commands are not 'use'd because they are in the
        - same directory
    */

    public function console()
    {
        $application = new Application($this->container, $this->events, 'v2');
        $application->setName('Systatic');

        $application->add(new InitCommand());
        $application->add(new BuildCommand());
        $application->add(new ClearSiteCommand());
        $application->add(new ClearCacheCommand());
        $application->add(new WordPressImportCommand());
        $application->add(new DeployCommand());
        $application->add(new ServeCommand());

        $application->run();
    }
}
