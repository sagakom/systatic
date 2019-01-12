<?php

namespace Thunderbird\Commands;

use Symfony\Component\Console\Command\Command as Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Thunderbird\Compiler\Compiler;
use Thunderbird\Config\Config;

class BuildCommand extends Command
{
    protected static $defaultName = 'build';

    protected function configure()
    {
        $this
            ->setDescription('Build Thunderbird site')
            ->setHelp('This command builds your static site.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Message
        $output->writeln('Building site...');

        // Create instances
        $config = new Config();
        $compiler = new Compiler();

        // Get an array of pages
        $files = glob($config->getConfig('CONTENT_DIR') . '/*.md', GLOB_BRACE);

        // Compile each of the pages
        foreach($files as $file)
        {
            $compiler->compile($file, 'index');
        }
    }
}