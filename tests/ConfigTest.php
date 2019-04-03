<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Damcclean\Systatic\Config\Config;

class ConfigTest extends TestCase
{
    public function setUp(): void
    {
        $this->config = new Config();
    }

    public function testCanGetConfigValue()
    {  
        $siteName = $this->config->getConfig('siteName');
        $this->assertSame($siteName, 'Awesome Website');
    }
}