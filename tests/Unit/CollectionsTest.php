<?php

namespace Tests;

use Damcclean\Systatic\Collections\Collections;

class CollectionsTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->collections = new Collections();

        $this->fakeStore = [
            'events' => [
                'name' => 'Events',
                'permalink' => '/events',
                'location' => './tests/fixtures/content/events',
                'items' => [],
            ],
        ];
    }

    public function testCanSaveCollectionStore()
    {
        $save = $this->collections->save($this->fakeStore);

        $this->assertTrue($save);
        $this->assertFileExists('./tests/fixtures/storage/collections.json');
    }

    public function testCanFetchCollectionStore()
    {
        $fetch = $this->collections->fetch();
        $this->assertIsArray($fetch);
    }

    public function testCanFetchCollectionStoreAsJson()
    {
        $fetch = $this->collections->fetchAsJson();
        $this->assertJson($fetch);
    }

    public function testCanIndexCollections()
    {
        $index = $this->collections->index();
        $this->assertIsArray($index);
    }

    public function testCanCreateCollection()
    {
        $create = $this->collections->create('posts', 'Posts', '/posts/', './tests/fixtures/content/posts');

        $this->assertIsArray($create);
        $this->assertContains('Posts', $create['collections']['posts']);
    }

    public function testCanGetACollection()
    {
        $save = $this->collections->save($this->fakeStore);
        $this->assertTrue($save);

        $get = $this->collections->get('events');
        $this->assertIsArray($get);
        $this->assertContains('Events', $get);
    }
}
