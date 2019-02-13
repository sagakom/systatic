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

        $this->config = new Config();
        $this->compiler = new Compiler();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Message
        $output->writeln('Building site...');

        // Get an array of pages (root directory)
        $files = glob($this->config->getConfig('pagesDir') . '/*.md', GLOB_BRACE);

        // Compile each of the pages (root directory)
        foreach($files as $file)
        {
            $this->compiler->compile($file);
        }

        // Get an array of pages (root + 1 dir)
        $files = glob($this->config->getConfig('pagesDir') . '/*/*.md', GLOB_BRACE);

        // Compile each of the pages (root + 1 dir)
        foreach($files as $file)
        {
            $this->compiler->compile($file);
        }
    }
}