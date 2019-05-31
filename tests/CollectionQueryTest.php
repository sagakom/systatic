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
                "filename" => "index.md",
                "title" => "Home",
                "slug" => "index",
                "view" => "index",
                "content" => "<p>This is my homepage content</p>",
                "meta" => []
            ],
            [
                "filename" => "about.md",
                "title" => "About Me",
                "slug" => "about",
                "view" => "index",
                "content" => "<p>Hello, I am a very interesting person. I enjoy water sports and volunteering at local football games.</p>",
                "meta" => []
            ],
            [
                "filename" => "contact.md",
                "title" => "Contact",
                "slug" => "contact",
                "view" => "contact",
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

    public function testGetByFileName()
    {
        $collections = $this->collections->save($this->store);
        $collections = $this->collections->fetch();

        $search = $this->query->getByFileName('index.md');

        $this->assertStringContainsString('<p>This is my homepage', json_encode($search));
    }

    public function testGetBySlug()
    {
        $collections = $this->collections->save($this->store);
        $collections = $this->collections->fetch();

        $search = $this->query->getBySlug('contact');

        $this->assertStringContainsString('<p>I love it when people', json_encode($search));
    }

    public function testGetByView()
    {
        $collections = $this->collections->save($this->store);
        $collections = $this->collections->fetch();

        $search = $this->query->getByView('index');

        $this->assertStringContainsString('Home', json_encode($search));
        $this->assertStringContainsString('About', json_encode($search));
        $this->assertThat(json_encode($search), $this->logicalNot($this->stringContains('Contact')));
    }
}