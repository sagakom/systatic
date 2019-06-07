<?php

namespace Damcclean\Systatic;

use Damcclean\Systatic\Commands\Commands;

class Systatic
{
    public function boot()
    {
        /*
            Commands
            - Register console commands
        */

        (new Commands())->console();
    }
}