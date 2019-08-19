<?php

namespace Tests;

use Damcclean\Systatic\Cache\Cache;

class CacheTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->cache = new Cache();

        file_write_contents('./tests/fixtures/storage/cache/pretend-view-cache-file.php', 'wip commits are good');
        file_write_contents('./tests/fixtures/storage/collections.json', '{}');
        file_write_contents('./tests/fixtures/storage/plugins.json', '{}');
        file_write_contents('./tests/fixtures/storage/console.json', '{}');
    }

    public function testCanClearViewCache()
    {
        $clear = $this->cache->clearViewCache();

        $this->assertFalse(file_exists('./tests/fixtures/storage/cache/pretend-view-cache-file.php'));
    }

    public function testCanClearStoreCache()
    {
        $clear = $this->cache->clearStoreCache();

        $this->assertFalse(file_exists('./tests/fixtures/storage/collections.json'));
        $this->assertFalse(file_exists('./tests/fixtures/storage/plugins.json'));
        $this->assertFalse(file_exists('./tests/fixtures/storage/console.json'));
    }

    public function testCanClearOutputDirectory()
    {
        file_write_contents('./tests/fixtures/dist/clear-file.html', '');
        $clear = $this->cache->clearSiteOutput();

        $this->assertFileNotExists('./tests/fixtures/dist/clear-file.html');
    }
}
