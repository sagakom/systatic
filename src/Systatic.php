<?php

namespace Damcclean\Systatic;

use Damcclean\Systatic\Plugins\Plugins;
use Damcclean\Systatic\Commands\Commands;

class Systatic
{
    public function boot()
    {
        (new Plugins())->register();
        (new Commands())->console();
    }
}