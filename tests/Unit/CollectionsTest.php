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

    public function testCollectionCanSave()
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
}