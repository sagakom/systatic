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
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        // Message
        $output->writeln('Clearing cache...');

        // Create instances
        $cache = new Cache();

        // Clear cache
        $cache->clearCache();
    }
}