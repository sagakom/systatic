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
        $env = $this->config->get('BAR');
        $this->assertSame($env, 'foo');
    }

    public function testCanGetConfigArray()
    {
        $array = $this->config->getArray();
        $this->assertIsArray($array);
    }

    public function testCanGetEnvValueFromFile()
    {
        $env = $this->config->env('BAR');
        $this->assertSame($env, 'foo');
    }

    public function testCanGetEnvValueFromSystem()
    {
        $env = $this->config->env('FOO');
        $this->assertSame($env, 'bar');
    }
}
