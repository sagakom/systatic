<?php

namespace Damcclean\Systatic\Console\Commands;

use Illuminate\Console\Command;
use Damcclean\Systatic\Build\Build;
use Damcclean\Systatic\Config\Config;

class BuildCommand extends Command
{
    protected $signature = 'build';
    protected $description = 'Builds Systatic site';

    public function __construct()
    {
        parent::__construct();

        $this->build = new Build();
        $this->config = new Config();
    }

    public function handle()
    {
        $this->info('Building site to ' . $this->config->get('locations.output') . '.');
        $this->build->build();
    }
}
