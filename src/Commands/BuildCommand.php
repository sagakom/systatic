<?php

namespace Thunderbird\Commands;

use Symfony\Component\Console\Command\Command as Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Dotenv\Dotenv;
use Parsedown;
use Jenssegers\Blade\Blade;

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

        // Load stuff for enviroment variables
        $dotenv = new Dotenv();
        $dotenv->load('./.env', './sample.env');

        // Env variables
        $site_name = getenv('SITE_NAME');
        $site_url = getenv('SITE_URL');
        $outputDir = getenv('OUTPUT_DIR');
        $contentDir = getenv('CONTENT_DIR');
        $assetsDir = getenv('ASSETS_DIR');
        $viewsDir = getenv('VIEWS_DIR');

        // Setup blade instance
        $blade = new Blade($viewsDir, './cache');

        // Get all files in the content directory with a markdown extention
        $files = glob($contentDir . '/*.md', GLOB_BRACE);

        // Loop through all of the markdown files
        foreach($files as $file) {

            // Generate a slug
            $slug = basename($file, '.md');

            // Get contents of content file
            $content = file_get_contents($file);

            // Parse the markdown content into HTML
            $content = $parsedown->text($content);

            // Templating

                // Echo the stuff to Blade template
                $page = $blade->make('page');

                    // Content
                    $blade->compiler()->directive('content', function () use ($content) {
                        return $content;
                    });

            // Output the HTML content into files
            file_put_contents($outputDir . '/' . $slug . '.html', $page);
        }

        // Copy assets to dist directory
        shell_exec("cp -r " . $assetsDir . " " . $outputDir);

    }
}