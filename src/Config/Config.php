<?php

namespace Damcclean\Systatic\Config;

use Dotenv\Dotenv;
use Illuminate\Config\Repository;
use Brick\VarExporter\VarExporter;

class Config
{
    public function __construct()
    {
        $this->config = new Repository(require CONFIGURATION);
    }

    public function get(string $key)
    {
        $config = $this->config->get($key);

        if ($config != null) {
            return $config;
        }

        if (strpos($key, '.') != false) {
            $key = str_replace('.', '_', $key);
        }

        return $this->env(strtoupper($key));
    }

    public function getArray()
    {
        return include CONFIGURATION;
    }

    public function updateArray(array $data)
    {
        $config = include CONFIGURATION;
        $config = array_merge($config, $data);

        file_write_contents(CONFIGURATION, '<?php '.PHP_EOL.VarExporter::export($config, true).';'.PHP_EOL);

        return $config;
    }

    public function env(string $key)
    {
        $dotenv = Dotenv::create(BASE);
        $dotenv->load();

        return getenv($key);
    }
}
