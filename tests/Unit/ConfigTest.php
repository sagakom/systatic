<?php

namespace Tests;

use Tests\TestCase;
use Damcclean\Systatic\Config\Config;

class ConfigTest extends TestCase
{
    public function setUp() : void
    {
        $this->config = new Config();
    }

    public function testCanGetConfigValue()
    {  
        $name = $this->config->get('name');
        $this->assertSame($name, 'Systatic');
    }

    public function testCanGetConfigArray()
    {
        $array = $this->config->getArray();
        $this->assertTrue(is_array($array));
    }

    public function testCanGetEnvValue()
    {
        $env = $this->config->env('APP_ENV');
        $this->assertSame($env, 'testing');
    }
}