<?php

namespace Damcclean\Systatic\Console\Commands;

use Illuminate\Console\Command;
use Damcclean\Systatic\Cache\Cache;

class ClearSiteCommand extends Command
{
    protected $signature = 'clear:site';
    protected $description = 'Clear compiled HTML files from your output directory.';

    public function __construct()
    {
        parent::__construct();
        $this->cache = new Cache();
    }

    public function handle()
    {
        $this->info('Clearing site...');
        $this->cache->clearSiteOutput();
    }
}
