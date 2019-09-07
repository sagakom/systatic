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

    /** @test */
    public function can_get_config_value()
    {
        $name = $this->config->get('name');
        $this->assertSame($name, 'Systatic');
    }

    public function can_get_config_value_with_env_fallback()
    {
        $env = $this->config->get('BAR');
        $this->assertSame($env, 'foo');
    }

    public function can_get_config_array()
    {
        $array = $this->config->getArray();
        $this->assertIsArray($array);
    }

    public function can_get_env_value_from_file()
    {
        $env = $this->config->env('BAR');
        $this->assertSame($env, 'foo');
    }

    public function can_get_env_value_from_system()
    {
        $env = $this->config->env('FOO');
        $this->assertSame($env, 'bar');
    }
}
