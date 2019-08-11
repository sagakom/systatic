<?php

namespace Damcclean\Systatic;

use NunoMaduro\Collision\Provider;
use Damcclean\Systatic\Plugins\Plugins;
use Damcclean\Systatic\Console\Kernel;

class Systatic
{
    public function boot()
    {
        (new Provider())->register();
        (new Plugins())->find();
        (new Kernel())->commands();
    }
}
