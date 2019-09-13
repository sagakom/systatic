<?php

namespace Damcclean\Systatic\Console\Commands;

use Illuminate\Console\Command;
use Damcclean\Systatic\Import\Ghost;

class GhostImportCommand extends Command
{
    protected $signature = 'import:ghost';
    protected $description = 'Import content to Systatic from Ghost.';

    public function __construct()
    {
        parent::__construct();

        $this->ghost = new Ghost();
    }

    public function handle()
    {
        $siteUrl = $this->ask('Enter your Ghost site URL');
        $apiKey = $this->ask('Enter your Ghost Content API Key');

        $import = $this->ghost->import($apiKey, $siteUrl);

        if ($import != true) {
            $output->error('Failed to import from Ghost');
            exit();
        }

        $this->info('Imported from Ghost!');
    }
}
