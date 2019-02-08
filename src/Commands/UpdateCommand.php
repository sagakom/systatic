<?php

namespace Thunderbird\Commands;

use Symfony\Component\Console\Command\Command as Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Thunderbird\Updater\Updater;

class UpdateCommand extends Command
{
    protected static $defaultName = 'update';

    protected function configure()
    {
        $this
            ->setDescription('Update Thunderbird')
            ->setHelp('This command updates Thunderbird.');
        
        $this->updater = new Updater();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Sends message to console indicating the update process has began
        $output->writeln('Updating Thunderbird...');

        // What version do you want to update to
        $helper = $this->getHelper('question');
        $question = new Question('What version do you want to update to? ');
        $version = $helper->ask($input, $output, $question);

        // Actually update
        $this->updater->updateThunderbird($version);
    }
}