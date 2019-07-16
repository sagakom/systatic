<?php

namespace Damcclean\Systatic\Commands;

use Damcclean\Systatic\Cache\Cache;
use Illuminate\Console\Command;

class ClearSiteCommand extends Command
{
    protected $signature = 'clear:site';
    protected $description = 'Clear HTML output files.';

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
