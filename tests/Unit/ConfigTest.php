<?php

namespace Tests;

use Damcclean\Systatic\Config\Config;

class ConfigTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->config = new Config();
    }

    public function testCanGetConfigValue()
    {
        $name = $this->config->get('name');
        $this->assertSame($name, 'Systatic');
    }

    public function testCanGetConfigValueWithEnvFallback()
    {
        $env = $this->config->get('env');
        $this->assertSame($env, 'testing');
    }

    public function testCanGetConfigArray()
    {
        $array = $this->config->getArray();
        $this->assertTrue(is_array($array));
    }

    public function testCanGetEnvValue()
    {
        $env = $this->config->env('ENV');
        $this->assertSame($env, 'testing');
    }
}
