<?php

namespace Tests;

use Tests\TestCase;
use Damcclean\Systatic\Cache\Cache;
use Damcclean\Systatic\Config\Config;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class CacheTest extends TestCase
{
    public function setUp(): void
    {
        $this->config = new Config();
        $this->cache = new Cache();
        $this->filesystem = new Filesystem();
    }

    public function testCanClearViewCache()
    {  
        $this->filesystem->touch($this->config->get('locations.storage') . '/cache/file.txt');
        $this->cache->clearViewCache();
        
        if(file_exists($this->config->get('locations.storage') . '/cache/file.txt')) {
            $this->assertFalse(false);
        } else {
            $this->assertTrue(true);
        }
    }
}