<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Thunderbird\Build\Build;

class SiteBuildTest extends TestCase
{
    public function testSiteCanBeBuilt()
    {  
        $build = new Build();
        $build = $build->build();

        $this
            ->assertSame(true, $build)
            ->assertFileExists('dist/index.html');
    }
}