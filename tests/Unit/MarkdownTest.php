<?php

namespace Tests;

use Damcclean\Systatic\Collections\Markdown;
use Damcclean\Systatic\Config\Config;
use Tests\TestCase;

class MarkdownTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->config = new Config();
        $this->markdown = new Markdown();
    }

    public function testCanParseMarkdown()
    {
        $file = './tests/fixtures/content/pages/contact-me.md';
        $collection = $this->config->getArray()['collections']['pages'];
        $collection['key'] = 'pages';

        $markdown = $this->markdown->parse($file, $collection);

        $this->assertIsArray($markdown);
        $this->assertSame($markdown['title'], 'Contact Me');
        $this->assertSame($markdown['slug'], 'contact');
        $this->assertSame($markdown['view'], 'contact');
        $this->assertStringContainsString('<p>', $markdown['content']);
    }
}
