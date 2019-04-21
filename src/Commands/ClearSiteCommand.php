<?php

namespace Damcclean\Systatic\Commands;

use Damcclean\Systatic\Config\Config;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Console\Command\Command as Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ClearSiteCommand extends Command
{
    protected static $defaultName = 'clear:site';

    protected function configure()
    {
        $this
            ->setDescription('Clear output directory')
            ->setHelp('This command clears all HTML files from your output directory.');

        $this->config = new Config();
        $this->filesystem = new Filesystem();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Message
        $output->writeln('<info>Clearing site...</info>');

        // Get a list of all HTML files
        $files = [];
        $files = array_merge(glob($this->config->getConfig('outputDir') . '/*.html', GLOB_BRACE), $files);

        // Get rid of all HTML files from output directory
        foreach($files as $file) {
            $this->filesystem->remove($file);
        }
    }
}
