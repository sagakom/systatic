<?php

namespace Thunderbird\Commands;

use Symfony\Component\Console\Command\Command as Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Parsedown;

class BuildCommand extends Command
{
    protected static $defaultName = 'build';

    protected function configure()
    {
        $this
            ->setDescription('Builds static site')
            ->setHelp('This command builds your static site.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        // Message
        $output->writeln('Building site...');

        // Convert markdown into html
        $parsedown = new Parsedown();

        $file = file_get_contents('./content/markdown-sample.md');

        $html = $parsedown->text($file);

        file_put_contents('./dist/index.php', $html);

    }
}