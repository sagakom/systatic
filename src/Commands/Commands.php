<?php

namespace Damcclean\Systatic\Commands;

use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Console\Application;
use Damcclean\Systatic\Plugins\Plugins;

class Commands
{
    public function __construct()
    {
        $this->plugins = new Plugins();
        $this->container = new Container();
        $this->events = new Dispatcher($this->container);
    }

    public function console()
    {
        $application = new Application($this->container, $this->events, 'v2');
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

        $pluginCommands = $this->plugins->commands();

        foreach($pluginCommands as $command) {
            $application->add(new $command());
        }

        $application->run();
    }
}
