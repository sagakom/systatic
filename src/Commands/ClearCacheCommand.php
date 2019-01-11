<?php

namespace Thunderbird\Commands;

use Symfony\Component\Console\Command\Command as Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class ClearCacheCommand extends Command
{
    protected static $defaultName = 'clear-cache';

    protected function configure()
    {
        $this
            ->setDescription('Clears site cache')
            ->setHelp('This command clears your cache directory. Helpful for debugging.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        // Message
        $output->writeln('Clearing cache...');

        // Create filesystem instance
        $fileSystem = new Filesystem();

        // Delete all of the files within the local/cache directory
        $fileSystem->remove(array('symlink', './local/cache', '*.php'));

    }
}