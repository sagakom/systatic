<?php

namespace Tests;

use Damcclean\Systatic\Collections\Collections;
use Damcclean\Systatic\Collections\Entries;
use Damcclean\Systatic\RefreshSite;
use Tests\TestCase;

class EntriesTest extends TestCase
{
    use RefreshSite;

    public function setUp() : void
    {
        parent::setUp();
        $this->entries = new Entries();
        $this->collections = new Collections();
        $this->collections->collect();
    }

    public function testCanCreateEntry()
    {
        $create = $this->entries->create('about-me', 'pages', [
            'title' => 'About Me'
        ], '<p>This is my place on the internet where I talk about things I like to do at the weekend.</p>');

        $this->assertTrue($create);
        $this->assertFileExists('./tests/fixtures/content/pages/about-me.md');
    }
}