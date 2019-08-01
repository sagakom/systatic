<?php

namespace Tests;

use Damcclean\Systatic\Cache\Cache;
use PHPUnit\Framework\TestCase as Base;
use Illuminate\Filesystem\Filesystem;

define('BASE', './tests/fixtures');
define('CONFIGURATION', './tests/fixtures/config.php');

class TestCase extends Base
{
    public function setUp() : void
    {
        parent::setUp();

        $cache = new Cache();
        $cache->clearViewCache();
        $cache->clearSiteOutput();

        $filesystem = new Filesystem();
        $filesystem->delete('./tests/fixtures/config.php');
        $filesystem->delete('./tests/fixtures/dist/*.html');
        $filesystem->delete('./tests/fixtures/dist/*/*.html');
        $filesystem->copy('./tests/fixtures/real-config.php', './tests/fixtures/config.php');
        file_write_contents('./tests/fixtures/storage/collections.json', '{}');
        file_write_contents('./tests/fixtures/storage/plugins.json', '{}');
    }
}
