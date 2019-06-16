<?php

namespace Damcclean\Systatic\Commands;

use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Command\Command as Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Damcclean\Systatic\Import\WordPress;

class WordPressImportCommand extends Command
{
    protected static $defaultName = 'import:wordpress';

    protected function configure()
    {
        $this
            ->setDescription('Import Pages and Posts from WordPress')
            ->setHelp('This command imports from WordPress using their REST API.');

        $this->wordpress = new WordPress();
    }

    /*
        Build the site
    */

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $question = new Question('<comment>Enter the base URL of your WordPress site:</comment> ');
        $baseUrl = $helper->ask($input, $output, $question);

        $import = $this->wordpress->import($baseUrl);

        if($import != true) {
            $output->writeln('<error>Failed to import from WordPress</error>');
            exit();
        }

        $output->writeln('<info>Imported from WordPress!</info>');
    }
}
