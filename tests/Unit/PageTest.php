<?php

namespace Tests;

use Damcclean\Systatic\Compiler\Page;
use Tests\TestCase;

class PageTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->page = new Page();
    }

    public function testCanReturnPage()
    {
        $data = [
            'filename' => './tests/fixtures/content/pages/index.md',
            'permalink' => '/index.html',
            'title' => 'Homepage',
            'slug' => 'index',
            'view' => 'index',
            'content' => '<p>This is the homepage of my wonderful website.</p>',
            'meta' => [
                'title' => 'Homepage'
            ],
            'last_updated' => null
        ];

        $page = $this->page->process($data);

        $this->assertIsArray($page);
        $this->assertSame($page['title'], 'Homepage');
        $this->assertSame($page['view'], 'index');
    }
}