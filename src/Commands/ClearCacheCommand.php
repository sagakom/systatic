<?php

namespace Damcclean\Systatic\Commands;

use Illuminate\Console\Command;
use Damcclean\Systatic\Cache\Cache;

class ClearCacheCommand extends Command
{
    protected $signature = 'clear:cache';
    protected $description = 'Clear site cache';

    public function handle()
    {
        $this->info('Clearing cache...');
        (new Cache())->clearCache();
    }
}
