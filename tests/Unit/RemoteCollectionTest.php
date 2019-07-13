<?php

namespace Tests;

use Damcclean\Systatic\Collections\Remote;
use Damcclean\Systatic\Config\Config;
use Tests\TestCase;

class RemoteCollectionTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->config = new Config();
        $this->remote = new Remote();
    }

    public function testCanProcessRemoteCollection()
    {
        $collection = $this->config->getArray()['collections']['favourites'];

        $remote = $this->remote->process($collection);

        $this->assertIsArray($remote);
        $this->assertStringContainsString($remote[0]['title'], 'Favourite foods');
    }
}