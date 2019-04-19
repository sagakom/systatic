<?php

namespace Damcclean\Systatic\Commands;

use Symfony\Component\Console\Application;
use Damcclean\Systatic\Commands\BuildCommand;

class Commands
{
    public function console()
    {
        $application = new Application('Systatic');

        $application->add(new BuildCommand());

        $application->run();
    }
}
