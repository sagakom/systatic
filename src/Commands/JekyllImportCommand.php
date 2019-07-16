<?php

namespace Damcclean\Systatic\Commands;

use Illuminate\Console\Command;
use Damcclean\Systatic\Import\Jekyll;

class JekyllImportCommand extends Command
{
    protected $signature = 'import:jekyll';
    protected $description = 'Import from Jekyll';

    public function __construct()
    {
        parent::__construct();

        $this->jekyll = new Jekyll();
    }

    public function handle()
    {
        $folder = $this->ask('What folder is your Jekyll site in?');

        $import = $this->jekyll->import($folder);

        if ($import != true) {
            $output->error('Failed to import from Jekyll');
            exit();
        }

        $this->info('Imported from Jekyll!');
    }
}
