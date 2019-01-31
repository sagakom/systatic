<?php

namespace Thunderbird\Commands;

use Symfony\Component\Console\Command\Command as Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class UpdateCommand extends Command
{
    protected static $defaultName = 'update';

    protected function configure()
    {
        $this
            ->setDescription('Update Thunderbird')
            ->setHelp('This command updates Thunderbird.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Sends message to console indicating the update process has began
        $output->writeln('Updating Thunderbird...');

        // What version do you want to update to
        $helper = $this->getHelper('question');
        $question = new Question('What version do you want to update to? ');
        $version = $helper->ask($input, $output, $question);

        // Download latest release from GitHub
        shell_exec("git clone -b " . $version . " --single-branch https://github.com/ThunderbirdSSG/Thunderbird.git local/updater/download");

        // Change into the release directory and remove the Git folder
        shell_exec("cd local/updater/download && rm -rf .git");

        // Copy across the src directory
        shell_exec("cp -a local/updater/download/src/* src");

        // Copy across the thunderbird console file
        shell_exec("cp local/updater/download/thunderbird ./");

        // Delete the downloaded release
        shell_exec("rm -rf local/updater/download");
    }
}