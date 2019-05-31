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
        Tests that we can get single config values
    */

    public function testCanGetConfigValue()
    {  
        $name = $this->config->getConfig('name');
        $this->assertSame($name, 'Systatic');
    }
}