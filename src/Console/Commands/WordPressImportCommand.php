<?php

namespace Damcclean\Systatic\Console\Commands;

use Illuminate\Console\Command;
use Damcclean\Systatic\Import\WordPress;

class WordPressImportCommand extends Command
{
    protected $signature = 'import:wordpress';
    protected $description = 'Import content to Systatic from WordPress.';

    public function __construct()
    {
        parent::__construct();

        $this->wordpress = new WordPress();
    }

    public function handle()
    {
        $baseUrl = $this->ask('Enter the base URL of your WordPress site');

        $import = $this->wordpress->import($baseUrl);

        if ($import != true) {
            $output->error('Failed to import from WordPress');
            exit();
        }

        $this->info('Imported from WordPress!');
    }
}
