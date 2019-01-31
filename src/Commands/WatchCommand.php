<?php

namespace Thunderbird\Commands;

use Symfony\Component\Console\Command\Command as Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;
use Thunderbird\Config\Config;

class WatchCommand extends Command
{
    protected static $defaultName = 'watch';

    protected function configure()
    {
        $this
            ->setDescription('Watch for changes in your Thunderbird site.')
            ->setHelp('This command rebuilds your site when changes have been detected.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Sends message to console indicating the watcher has started
        $output->writeln('Watching site...');

        // Create instances
        $files = new Illuminate\Filesystem\Filesystem;
        $tracker = new JasonLewis\ResourceWatcher\Tracker;
        $watcher = new JasonLewis\ResourceWatcher\Watcher($tracker, $files);
        $config = new Config();

        // Create a watcher for files
        $listener = $watcher->watch($config->getConfig('contentDir'));
        $listener = $watcher->watch($config->getConfig('viewsDir'));

        // Watch for any changes
        $listener->anything(function($event, $resource, $path) {
            $command = $this->getApplication()->find('build');
            $greetInput = new ArrayInput();
            return $command->run($greetInput, $output);
        });

        // Begin the watcher
        $watcher->start();
    }
}