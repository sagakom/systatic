<?php

namespace Damcclean\Systatic\Commands;

use Illuminate\Console\Command;
use Damcclean\Systatic\Import\Ghost;

class GhostImportCommand extends Command
{
    protected $signature = 'import:ghost';
    protected $description = 'Import from Ghost';

    public function __construct()
    {
        parent::__construct();

        $this->ghost = new Ghost();
    }

    public function handle()
    {
        $apiKey = $this->ask('Enter your Ghost Content API Key');

        $import = $this->ghost->import($apiKey);

        if ($import != true) {
            $output->error('Failed to import from Ghost');
            exit();
        }

        $this->info('Imported from Ghost!');
    }
}
