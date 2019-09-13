<?php

namespace Damcclean\Systatic\Console\Commands;

use Illuminate\Console\Command;
use Damcclean\Systatic\Cache\Cache;

class ClearCacheCommand extends Command
{
    protected $signature = 'clear:cache';
    protected $description = 'Clear store and view cache files.';

    public function __construct()
    {
        parent::__construct();
        $this->cache = new Cache();
    }

    public function handle()
    {
        $this->info('Clearing cache...');
        $this->cache->clearEverything();
    }
}
