<?php

namespace Tests;

use Tests\TestCase;
use Damcclean\Systatic\Config\Config;

class ConfigTest extends TestCase
{
    public function setUp(): void
    {
        $this->config = new Config();
    }

    /*
        Test we can get a configuration value
    */

    public function testCanGetConfigValue()
    {  
        $name = $this->config->get('name');
        $this->assertSame($name, 'Systatic');
    }

    public function testCanGetEnvValue()
    {
        $env = $this->config->env('env');
        $this->assertSame($env, 'testing');
    }
}