<?php

namespace Tests;

use Tests\TestCase;
use Damcclean\Systatic\Collections\Query;
use Damcclean\Systatic\Collections\Collections;

class CollectionQueryTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->query = new Query();
        $this->collections = new Collections();

        $this->store = [
            [
                "filename" => "index",
                "title" => "Home",
                "slug" => "index",
                "content" => "<p>This is my homepage content</p>",
                "meta" => []
            ],
            [
                "filename" => "about",
                "title" => "About Us",
                "slug" => "about",
                "content" => "<p>Hello, I am a very interesting person. I enjoy water sports and volunteering at local football games.</p>",
                "meta" => []
            ],
            [
                "filename" => "contact",
                "title" => "Contact",
                "slug" => "contact",
                "content" => "<p>I love it when people get in touch with me. I try to get back to them right away.</p>",
                "meta" => []
            ],
        ];
    }

    public function testGetAll()
    {
        $collections = $this->collections->save($this->store);
        $collections = $this->collections->fetch();

        $all = $this->query->getAll();

        $this->assertStringContainsString('<p>Hello, I am a very', json_encode($all));
    }
}