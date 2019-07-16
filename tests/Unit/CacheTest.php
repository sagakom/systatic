<?php

namespace Tests;

use Tests\TestCase;
use Damcclean\Systatic\Cache\Cache;
use Damcclean\Systatic\Filesystem\Filesystem;

class CacheTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->cache = new Cache();
        $this->filesystem = new Filesystem();

        $this->filesystem->dump('./tests/fixtures/storage/cache/pretend-view-cache-file.php', 'wip commits are good');
        $this->filesystem->dump('./tests/fixtures/storage/collections.json', '{}');
        $this->filesystem->dump('./tests/fixtures/storage/plugins.json', '{}');
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
    }

    public function testCanClearOutputDirectory()
    {
        (new Filesystem())->createFile('./tests/fixtures/dist/clear-file.html');
        $clear = $this->cache->clearSiteOutput();
        $this->assertFileNotExists('./tests/fixtures/dist/clear-file.html');
    }
}
