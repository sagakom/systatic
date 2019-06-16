<?php

namespace Damcclean\Systatic\Commands;

use Illuminate\Console\Command;
use Damcclean\Systatic\Config\Config;

class ServeCommand extends Command
{
    protected $signature = 'serve';
    protected $description = 'Serve Systatic';

    public function __construct()
    {
        parent::__construct();

        $this->config = new Config();
    }
    
    public function handle()
    {
        $host = 'localhost';
        $port = 9000;

        if(array_key_exists('server', $this->config->getArray())) {
            if(array_key_exists('host', $this->config->getArray()['server'])) {
                $host = $this->config->get('server.host');
            }

            if(array_key_exists('port', $this->config->getArray()['server'])) {
                $port = $this->config->get('server.port');
            }
        }

        $this->info('Starting server on ' . $host . ':' . $port);

        passthru('php -S ' . $host . ':' . $port . ' -t ' . $this->config->get('locations.output'));
    }
}
