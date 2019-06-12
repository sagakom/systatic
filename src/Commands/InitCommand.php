<?php

namespace Damcclean\Systatic\Commands;

use Damcclean\Systatic\Filesystem\Filesystem;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Command\Command as Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InitCommand extends Command
{
    protected static $defaultName = 'init';

    protected function configure()
    {
        $this
            ->setDescription('Initialize Systatic')
            ->setHelp('This command initializes a new Systatic site.');

        $this->filesystem = new Filesystem();
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $base = getcwd();

        $this->filesystem->copyDir($base . '/vendor/damcclean/systatic/stubs/site', $base);

        $question = new ConfirmationQuestion('<question>Do you want to copy the Laravel Valet driver?</question> (y/N) ', false);
        $helper = $this->getHelper('question');

        if($helper->ask($input, $output, $question)) {
            $this->filesystem->copyDir($base . '/vendor/damcclean/systatic/stubs/valet', $base);
        }

        $output->writeln("<info>All that's left now is for you to build your site! - php systatic build");
    }
}
