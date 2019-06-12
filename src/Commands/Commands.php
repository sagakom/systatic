<?php

namespace Damcclean\Systatic\Commands;

use Symfony\Component\Console\Application;
use Damcclean\Systatic\Commands\InitCommand;
use Damcclean\Systatic\Commands\BuildCommand;
use Damcclean\Systatic\Commands\ClearSiteCommand;
use Damcclean\Systatic\Commands\ClearCacheCommand;

class Commands
{
    /*
        Bootstrap all of the avaliable console commands
    */

    public function console()
    {
        $application = new Application('Systatic');

        $application->add(new InitCommand());
        $application->add(new BuildCommand());
        $application->add(new ClearSiteCommand());
        $application->add(new ClearCacheCommand());

        $application->run();
    }
}
