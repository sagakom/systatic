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

        // Generate html files from markdown content
        $parsedown = new Parsedown();

        // Get all files in the content directory with a markdown extention
        $files = glob('./content/*.md', GLOB_BRACE);

        // Loop through all of the markdown files
        foreach($files as $file) { 

            // Generate a slug
            $slug = basename($file, '.md');

            // Get contents of content file
            $markdownContent = file_get_contents($file);

            // Parse the markdown content into HTML
            $content = $parsedown->text($markdownContent);

            // Output the HTML content into files
            $output = './dist/' . $slug . '.html';
            file_put_contents($output, $content);
        }

        shell_exec("cp -r './assets' './dist'");

    }
}