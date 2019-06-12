<?php

namespace Damcclean\Systatic\Commands;

use Illuminate\Console\Command;
use Damcclean\Systatic\Build\Build;

class BuildCommand extends Command
{
    protected $signature = 'build';
    protected $description = 'Builds Systatic site';

    public function __construct()
    {
        parent::__construct();
        $this->build = new Build();
    }

    public function handle()
    {
        $this->info('Build site...');
        $this->build->build();
    }
}
