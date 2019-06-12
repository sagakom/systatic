<?php

namespace Damcclean\Systatic\Commands;

use Illuminate\Console\Application;

class Commands
{
    /*
        Load application comands
        - Commands are not 'use'd because they are in the
        - same directory
    */

    public function console()
    {
        $application = new Application('v2');
        $application->setName('Systatic');

        $application->add(new InitCommand());
        $application->add(new BuildCommand());
        $application->add(new ClearSiteCommand());
        $application->add(new ClearCacheCommand());

        $application->run();
    }
}
