<?php

namespace Damcclean\Systatic\Commands;

use Illuminate\Console\Command;
use Damcclean\Systatic\Build\Build;
use Damcclean\Systatic\Filesystem\Filesystem;

class DeployCommand extends Command
{
    protected $signature = 'deploy';
    protected $description = 'Deploy Systatic';

    public function __construct()
    {
        parent::__construct();
        $this->filesystem = new Filesystem();
        $this->build = new Build();
    }
    
    public function handle()
    {
        $location = $this->choice('Where would you like to deploy?', [
            'Netlify', 
            'Heroku', 
            'Github Pages', 
            'Amazon S3',
            'SFTP'
        ], 0);

        $this->info('Deploying to ' . $location);
        $build = $this->build->build();

        if($location === "Netlify") {
            if(!file_exists(BASE . '/netlify.toml')) {
                $this->line('Pushed the Netlify configuration file, it did not already exist.');
                $this->filesystem->copyDir(BASE . '/vendor/damcclean/systatic/stubs/netlify', BASE);
            }

            $cliInstalled = shell_exec('netlify');

            if(!$cliInstalled) {
                $this->error('The Netlify CLI does not seem to be installed. Please install the Netlify CLI and try again.');
                exit();
            }

            shell_exec('netlify deploy');
        }

        if($location === "Heroku") {
            if(!file_exists(BASE . '/Procfile')) {
                $this->line('Pushed the Heroku Procfile, it did not already exist.');
                $this->filesystem->copy(BASE . '/vendor/damcclean/systatic/stubs/heroku/Procfile', BASE . '/Procfile');
            }

            if(!file_exists(BASE . '/heroku.sh')) {
                $this->line('Pushed the Heroku Deploy script, it did not already exist.');
                $this->filesystem->copy(BASE . '/vendor/damcclean/systatic/stubs/heroku/heroku.sh', BASE . '/heroku.sh');
            }

            $cliInstalled = shell_exec('heroku --version');

            if(!$cliInstalled) {
                $this->error('The Heroku CLI does not seem to be installed. Please install the Heroku CLI and try again.');
                exit();
            }

            shell_exec('heroku create');
        }

        if($location === "Github Pages") {
            //
        }

        if($location === "Amazon S3") {
            //
        }

        if($location === "SFTP") {
            //
        }
    }
}