<?php

namespace Damcclean\Systatic\Commands;

use Illuminate\Console\Command;
use Damcclean\Systatic\Config\Config;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class ClearSiteCommand extends Command
{
    protected $signature = 'clear:site';
    protected $description = 'Clear HTML output files.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $config = new Config();
        $filesystem = new Filesystem();

        $this->info('Clearing site...');

        // Get a list of all HTML files
        $files = [];
        $files = array_merge(glob($config->get('locations.output') . '/*.html', GLOB_BRACE), $files);

        // Get rid of all HTML files from output directory
        foreach($files as $file) {
            $filesystem->remove($file);
        }
    }
}
