<?php

namespace Damcclean\Systatic\Config;

use Illuminate\Config\Repository;
use Symfony\Component\Dotenv\Dotenv;

class Config
{
    public function __construct()
    {
        $this->env = new Dotenv();
        $this->config = new Repository(require CONFIGURATION);
    }

    public function get($key)
    {
        return $this->config->get($key);
    }

    public function getArray()
    {
        $config = include(CONFIGURATION);
        return $config;
    }

    public function updateArray($data)
    {
        $config = include(CONFIGURATION);
        $config = array_merge($config, $data);

        $str = '<?php ' . PHP_EOL
            . 'return '
            . var_export_new($config, true) . ';' . PHP_EOL;

        file_write_contents(CONFIGURATION, $str);

        return $config;
    }

    public function env($key)
    {
        $env = $this->env->load(BASE . '/.env');
        return $_ENV[$key];
    }
}
