<?php

namespace Damcclean\Systatic\Commands;

use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Command\Command as Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Damcclean\Systatic\Import\WordPress;
use Damcclean\Systatic\Config\Config;

class WordPressImportCommand extends Command
{
    protected static $defaultName = 'import:wordpress';

    protected function configure()
    {
        $this
            ->setDescription('Import Pages and Posts from WordPress')
            ->setHelp('This command imports from WordPress using their REST API.');

        $this->wordpress = new WordPress();
        $this->config = new Config();
    }

    /*
        Build the site
    */

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $question = new Question('<comment>Enter the base URL of your WordPress site:</comment> ');
        $baseUrl = $helper->ask($input, $output, $question);

        $apiUrl = $baseUrl . '/wp-json/wp/v2';

        $pages = json_decode(file_get_contents($apiUrl . '/pages'), true);

        foreach($pages as $page) {
            $contents = 
                '---' .
                'title: "' . $page['title']['rendered'] . '"' .
                'slug: "' . $page['slug'] . '"' .
                'excerpt: "' . $page['excerpt']['rendered'] . '"' .
                'date: "' . $page['date'] . '"' .
                '---' .
                $page['content']['rendered'];

            $filename = $this->config->get('locations.content') . '/' . $page['slug'] . '.md';

            file_put_contents($filename, $contents);
        }

        $output->writeln('<info>Imported from WordPress!</info>');
    }
}
