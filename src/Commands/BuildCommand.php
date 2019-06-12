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
    }

    public function handle()
    {
        $this->info('Build site...');
        (new Build())->build();
    }
}
