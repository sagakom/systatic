<?php

namespace Tests;

use Tests\TestCase;
use Damcclean\Systatic\Collections\Collections;

class CollectionsTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->collections = new Collections();
    }

    public function testCanSaveCollectionStore()
    {
        $fakeStore = [
            'events' => [
                'name' => 'Events',
                'permalink' => '/events',
                'location' => './content/events',
                'items' => []
            ]
        ];

        $save = $this->collections->save($fakeStore);

        $this->assertTrue($save);
        $this->assertFileExists('./tests/fixtures/storage/collections.json');
    }

    public function testCanFetchCollectionStore()
    {
        $fetch = $this->collections->fetch();

        $this->assertTrue(is_array($fetch));
    }

    public function testCanFetchCollectionStoreAsJson()
    {
        $fetch = $this->collections->fetchAsJson();

        $this->assertJson($fetch);
    }
}