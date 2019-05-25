<?php

namespace Tests;

use Tests\TestCase;
use Damcclean\Systatic\Collections\Collections;
use Damcclean\Markdown\MetaParsedown;

class CollectionsTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->collections = new Collections();
        $this->parsedown = new MetaParsedown();
    }

    public function testCollectMethod()
    {
        // TODO
    }

    public function testStoreCollection()
    {
        // TODO
    }

    public function testFetchCollectionStore()
    {
        // $fetch = $this->collections->fetch();

        // echo $fetch;
        // $this->assertNotNull($fetch);
    }

    public function testMarkdownWithFrontMatter()
    {
        $file = './tests/site/content/markdown_with_frontmatter.md';
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
        $file = './tests/site/content/markdown_without_frontmatter.md';
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
        $file = './tests/site/content/markdown_with_html_inside.md';
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
        $file = './tests/site/content/dot_markdown.markdown';
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
        $file = './tests/site/content/front-matter-slug.md';
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
        $file = './tests/site/content/front-matter-title.md';
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
        $file = './tests/site/content/front-matter-without-title.md';
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
        $file = './tests/site/content/front-matter-view.md';
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
        $file = './tests/site/content/front-matter-view-slash.md';
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
        $file = './tests/site/content/front-matter-view-dot.md';
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
        $file = './tests/site/content/cool.md';
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
        $file = './tests/site/content/cool2.html';
        $markdown = $this->collections->html($file);
        
        $expected = [
            'filename' => $file,
            'title' => 'Hey',
            'slug' => 'cool2',
            'view' => 'cool2',
            'content' => file_get_contents($file),
            'meta' => []
        ];

        $this->assertSame($expected, $markdown);
    }

    public function testHtmlNormal()
    {
        $file = './tests/site/content/html_standard.html';
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