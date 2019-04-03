<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Damcclean\Systatic\Build\Build;

class SiteBuildTest extends TestCase
{
    public function testSiteCanBeBuilt()
    {  
        $build = new Build();
        $build = $build->build();

        $this->assertSame(true, $build);
        $this->assertFileExists('dist/index.html');
    }
}