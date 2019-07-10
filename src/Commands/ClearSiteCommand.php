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

        $this->config = new Config();
        $this->filesystem = new Filesystem();
    }

    public function handle()
    {
        $this->info('Clearing site...');

        $files = [];
        $files = array_merge(glob($this->config->get('locations.output') . '/*.html', GLOB_BRACE), $files);
        $files = array_merge(glob($this->config->get('locations.output') . '/*/*.html', GLOB_BRACE), $files);
        $files = array_merge(glob($this->config->get('locations.output') . '/*/*/*.html', GLOB_BRACE), $files);
        $files = array_merge(glob($this->config->get('locations.output') . '/*/*/*/*.html', GLOB_BRACE), $files);

        foreach($files as $file) {
            if(array_key_exists('whitelist', $this->config->getArray())) {
                $whitelist = $this->config->getArray()['whitelist'];

                foreach($whitelist as $item) {
                    if(!$file === $item) {
                        $this->filesystem->remove($file);
                    }
                }
            } else {
                $this->filesystem->remove($file);
            }
        }
    }
}
