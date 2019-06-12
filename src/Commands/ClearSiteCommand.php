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

    protected function __construct()
    {
        $this->config = new Config();
        $this->filesystem = new Filesystem();
    }

    public function handle()
    {
        $this->info('Clearing site...');

        // Get a list of all HTML files
        $files = [];
        $files = array_merge(glob($this->config->get('locations.output') . '/*.html', GLOB_BRACE), $files);

        // Get rid of all HTML files from output directory
        foreach($files as $file) {
            $this->filesystem->remove($file);
        }
    }
}
