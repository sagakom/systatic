<?php

namespace Damcclean\Systatic\Commands;

use Damcclean\Systatic\Cache\Cache;
use Symfony\Component\Console\Command\Command as Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ClearCacheCommand extends Command
{
    protected static $defaultName = 'clear:cache';

    protected function configure()
    {
        $this
            ->setDescription('Clear site cache')
            ->setHelp('This command clears all Systatic cache files.');

        $this->cache = new Cache();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Message
        $output->writeln('<info>Clearing cache...</info>');

        // Clear site cache
        $this->cache->clearCache();
    }
}
