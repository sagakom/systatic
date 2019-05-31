<?php

namespace Tests;

use Tests\TestCase;
use Damcclean\Systatic\Config\Config;
use Damcclean\Systatic\Collections\Collections;
use Damcclean\Markdown\MetaParsedown;

class CollectionsTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->config = new Config();
        $this->collections = new Collections();
        $this->parsedown = new MetaParsedown();
    }

    public function testSave()
    {
        $store = [
            [
                "filename" => "index",
                "title" => "Home",
                "slug" => "index",
                "content" => "<p>This is my homepage content</p>",
                "meta" => []
            ]
        ];

        $save = $this->collections->save($store);

        $this->assertSame(true, $save);
        $this->assertFileExists($this->config->getConfig('locations.storage') . '/store.json');
    }

    public function testFetch()
    {
        $fetch = $this->collections->fetch();
        $this->assertNotNull($fetch);
    }

    public function testFetchAsJson()
    {
        $fetch = $this->collections->fetchAsJson();
        $this->assertJson($fetch);
    }

    public function testMarkdownWithFrontMatter()
    {
        $file = './tests/fixtures/content/markdown_with_frontmatter.md';
        $markdown = $this->collections->markdown($file);
        
        $expected = [
            'filename' => $file,
            'title' => 'I love Music!!',
            'slug' => 'markdown_with_frontmatter',
            'view' => 'index',
            'content' => $this->parsedown->text(file_get_contents($file)),
            'meta' => $this->parsedown->meta(file_get_contents($file))
        ];

        $this->assertSame($expected, $markdown);
    }

    public function testMarkdownWithoutFrontMatter()
    {
        $file = './tests/fixtures/content/markdown_without_frontmatter.md';
        $markdown = $this->collections->markdown($file);
        
        $expected = [
            'filename' => $file,
            'title' => 'markdown_without_frontmatter',
            'slug' => 'markdown_without_frontmatter',
            'view' => 'index',
            'content' => $this->parsedown->text(file_get_contents($file)),
            'meta' => $this->parsedown->meta(file_get_contents($file))
        ];

        $this->assertSame($expected, $markdown);
    }

    public function testMarkdownWithHtmlInContent()
    {
        $file = './tests/fixtures/content/markdown_with_html_inside.md';
        $markdown = $this->collections->markdown($file);
        
        $expected = [
            'filename' => $file,
            'title' => 'I love Trees!!',
            'slug' => 'markdown_with_html_inside',
            'view' => 'index',
            'content' => $this->parsedown->text(file_get_contents($file)),
            'meta' => $this->parsedown->meta(file_get_contents($file))
        ];

        $html = '<span class="awesome"><strong>Awesome</strong></span>';

        $this->assertSame($expected, $markdown);
        $this->assertStringContainsString($html, $markdown['content']);
    }

    public function testMarkdownUsingDotMarkdownFileExtension()
    {
        $file = './tests/fixtures/content/dot_markdown.markdown';
        $markdown = $this->collections->markdown($file);
        
        $expected = [
            'filename' => $file,
            'title' => 'Trees are my home',
            'slug' => 'dot_markdown',
            'view' => 'index',
            'content' => $this->parsedown->text(file_get_contents($file)),
            'meta' => $this->parsedown->meta(file_get_contents($file))
        ];

        $this->assertSame($expected, $markdown);
    }

    public function testMarkdownWithFrontMatterSlug()
    {
        $file = './tests/fixtures/content/front-matter-slug.md';
        $markdown = $this->collections->markdown($file);
        
        $expected = [
            'filename' => $file,
            'title' => 'We have a slug',
            'slug' => 'awesome',
            'view' => 'index',
            'content' => $this->parsedown->text(file_get_contents($file)),
            'meta' => $this->parsedown->meta(file_get_contents($file))
        ];

        $this->assertSame($expected, $markdown);
    }

    public function testMarkdownWithFrontMatterTitle()
    {
        $file = './tests/fixtures/content/front-matter-title.md';
        $markdown = $this->collections->markdown($file);
        
        $expected = [
            'filename' => $file,
            'title' => 'Hey',
            'slug' => 'front-matter-title',
            'view' => 'index',
            'content' => $this->parsedown->text(file_get_contents($file)),
            'meta' => $this->parsedown->meta(file_get_contents($file))
        ];

        $this->assertSame($expected, $markdown);
    }

    public function testMarkdownWithoutTitle()
    {
        $file = './tests/fixtures/content/front-matter-without-title.md';
        $markdown = $this->collections->markdown($file);
        
        $expected = [
            'filename' => $file,
            'title' => 'front-matter-without-title',
            'slug' => 'front-matter-without-title',
            'view' => 'index',
            'content' => $this->parsedown->text(file_get_contents($file)),
            'meta' => $this->parsedown->meta(file_get_contents($file))
        ];

        $this->assertSame($expected, $markdown);
    }

    public function testMarkdownWithFrontMatterView()
    {
        $file = './tests/fixtures/content/front-matter-view.md';
        $markdown = $this->collections->markdown($file);
        
        $expected = [
            'filename' => $file,
            'title' => 'front-matter-view',
            'slug' => 'front-matter-view',
            'view' => 'cool',
            'content' => $this->parsedown->text(file_get_contents($file)),
            'meta' => $this->parsedown->meta(file_get_contents($file))
        ];

        $this->assertSame($expected, $markdown);
    }

    public function testMarkdownFrontMatterViewAsSlash()
    {
        $file = './tests/fixtures/content/front-matter-view-slash.md';
        $markdown = $this->collections->markdown($file);
        
        $expected = [
            'filename' => $file,
            'title' => 'front-matter-view-slash',
            'slug' => 'front-matter-view-slash',
            'view' => 'something/another',
            'content' => $this->parsedown->text(file_get_contents($file)),
            'meta' => $this->parsedown->meta(file_get_contents($file))
        ];

        $this->assertSame($expected, $markdown);
    }

    public function testMarkdownFrontMatterViewAsDot()
    {
        $file = './tests/fixtures/content/front-matter-view-dot.md';
        $markdown = $this->collections->markdown($file);
        
        $expected = [
            'filename' => $file,
            'title' => 'front-matter-view-dot',
            'slug' => 'front-matter-view-dot',
            'view' => 'something/another',
            'content' => $this->parsedown->text(file_get_contents($file)),
            'meta' => $this->parsedown->meta(file_get_contents($file))
        ];

        $this->assertSame($expected, $markdown);
    }

    public function testMarkdownFileNameSameNameAsView()
    {
        $file = './tests/fixtures/content/cool.md';
        $markdown = $this->collections->markdown($file);
        
        $expected = [
            'filename' => $file,
            'title' => 'Hey',
            'slug' => 'cool',
            'view' => 'cool',
            'content' => $this->parsedown->text(file_get_contents($file)),
            'meta' => $this->parsedown->meta(file_get_contents($file))
        ];

        $this->assertSame($expected, $markdown);
    }

    public function testHtmlFileNameSameNameAsView()
    {
        $file = './tests/fixtures/content/cool2.html';
        $markdown = $this->collections->html($file);
        
        $expected = [
            'filename' => $file,
            'title' => 'cool2',
            'slug' => 'cool2',
            'view' => 'cool2',
            'content' => file_get_contents($file),
            'meta' => []
        ];

        $this->assertSame($expected, $markdown);
    }

    public function testHtmlNormal()
    {
        $file = './tests/fixtures/content/html_standard.html';
        $markdown = $this->collections->html($file);
        
        $expected = [
            'filename' => $file,
            'title' => 'html_standard',
            'slug' => 'html_standard',
            'view' => 'index',
            'content' => file_get_contents($file),
            'meta' => []
        ];

        $this->assertSame($expected, $markdown);
    }
}