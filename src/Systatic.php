<?php

namespace Damcclean\Systatic;

use Damcclean\Systatic\Plugins\Plugins;
use Damcclean\Systatic\Console\Kernel;

class Systatic
{
    public function boot()
    {
        (new Plugins())->register();
        (new Kernel())->commands();
    }
}
