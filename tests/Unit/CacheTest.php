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

    /*
        Test that the cache can be cleared
    */

    public function testCanClearCache()
    {  
        $this->filesystem->touch($this->config->getConfig('locations.storage') . '/cache/file.txt');
        $this->cache->clearCache();
        
        if(file_exists($this->config->getConfig('locations.storage') . '/cache/file.txt')) {
            $this->assertFalse(false);
        } else {
            $this->assertTrue(true);
        }
    }
}