<?php

namespace Damcclean\Systatic;

use NunoMaduro\Collision\Provider;
use Damcclean\Systatic\Console\Kernel;
use Damcclean\Systatic\Plugins\Plugins;

class Systatic
{
    public function boot()
    {
        (new Provider())->register();
        (new Plugins())->find();
        (new Kernel())->commands();
    }
}
