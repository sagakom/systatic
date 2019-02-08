<?php

namespace Thunderbird\Commands;

use Symfony\Component\Console\Command\Command as Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Thunderbird\Cache\Cache;

class ClearCacheCommand extends Command
{
    protected static $defaultName = 'clear:cache';

    protected function configure()
    {
        $this
            ->setDescription('Clear site cache')
            ->setHelp('This command clears your cache directory. Helpful for debugging.');

        $this->cache = new Cache();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Clearing cache...');
        $this->cache->clearCache();
    }
}