<?php

namespace Damcclean\Systatic\Console\Commands;

use Damcclean\Systatic\Redirects;
use Damcclean\Systatic\Cache\Cache;
use Damcclean\Systatic\Collections\Collections;
use Illuminate\Console\Command;
use Damcclean\Systatic\Config\Config;

class BuildCommand extends Command
{
    protected $signature = 'build';
    protected $description = 'Build your site to your output directory.';

    public function __construct()
    {
        parent::__construct();

        $this->config = new Config();
    }

    public function handle()
    {
        $this->info('Building site to '.$this->config->get('locations.output').'.');

        (new Collections())->collect();
        (new Redirects())->build();
        (new Cache())->clearStoreCache();
    }
}
