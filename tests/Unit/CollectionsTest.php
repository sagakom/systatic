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

        $this->collection = [
            'key' => 'pages',
            'name' => 'Pages',
            'permalink' => '/',
            'location' => './tests/fixtures/content'
        ];
    }

    // public function testSave()
    // {
    //     $store = [
    //         [
    //             'key' => 'blog',
    //             'name' => 'Blog',
    //             'permalink' => '/',
    //             'location' => './tests/fixtures/content',
    //             'view' => null,
    //             'items' => [
    //                 [
    //                     "filename" => "index",
    //                     "permalink" => "/index.html",
    //                     "title" => "Home",
    //                     "slug" => "index",
    //                     "content" => "<p>This is my homepage content</p>",
    //                     "meta" => []
    //                 ]
    //             ]
    //         ]
    //     ];

    //     $save = $this->collections->save($store);

    //     $this->assertSame(true, $save);
    //     $this->assertFileExists($this->config->get('locations.storage') . '/store.json');
    // }

    // public function testFetch()
    // {
    //     $fetch = $this->collections->fetch();
    //     $this->assertNotNull($fetch);
    // }

    // public function testFetchAsJson()
    // {
    //     $fetch = $this->collections->fetchAsJson();
    //     $this->assertJson($fetch);
    // }

    // public function testMarkdownWithFrontMatter()
    // {
    //     $file = './tests/fixtures/content/markdown_with_frontmatter.md';
    //     $markdown = $this->collections->markdown($file, $this->collection);
        
    //     $expected = [
    //         'filename' => $file,
    //         'permalink' => '/markdown_with_frontmatter.html',
    //         'title' => 'I love Music!!',
    //         'slug' => 'markdown_with_frontmatter',
    //         'view' => 'index',
    //         'content' => $this->parsedown->text(file_get_contents($file)),
    //         'meta' => $this->parsedown->meta(file_get_contents($file))
    //     ];

    //     $this->assertSame($expected, $markdown);
    // }

    // public function testMarkdownWithoutFrontMatter()
    // {
    //     $file = './tests/fixtures/content/markdown_without_frontmatter.md';
    //     $markdown = $this->collections->markdown($file, $this->collection);
        
    //     $expected = [
    //         'filename' => $file,
    //         'permalink' => '/markdown_without_frontmatter.html',
    //         'title' => 'markdown_without_frontmatter',
    //         'slug' => 'markdown_without_frontmatter',
    //         'view' => 'index',
    //         'content' => $this->parsedown->text(file_get_contents($file)),
    //         'meta' => $this->parsedown->meta(file_get_contents($file))
    //     ];

    //     $this->assertSame($expected, $markdown);
    // }

    // public function testMarkdownWithHtmlInContent()
    // {
    //     $file = './tests/fixtures/content/markdown_with_html_inside.md';
    //     $markdown = $this->collections->markdown($file, $this->collection);
        
    //     $expected = [
    //         'filename' => $file,
    //         'permalink' => '/markdown_with_html_inside.html',
    //         'title' => 'I love Trees!!',
    //         'slug' => 'markdown_with_html_inside',
    //         'view' => 'index',
    //         'content' => $this->parsedown->text(file_get_contents($file)),
    //         'meta' => $this->parsedown->meta(file_get_contents($file))
    //     ];

    //     $html = '<span class="awesome"><strong>Awesome</strong></span>';

    //     $this->assertSame($expected, $markdown);
    //     $this->assertStringContainsString($html, $markdown['content']);
    // }

    // public function testMarkdownUsingDotMarkdownFileExtension()
    // {
    //     $file = './tests/fixtures/content/dot_markdown.markdown';
    //     $markdown = $this->collections->markdown($file, $this->collection);
        
    //     $expected = [
    //         'filename' => $file,
    //         'permalink' => '/dot_markdown.html',
    //         'title' => 'Trees are my home',
    //         'slug' => 'dot_markdown',
    //         'view' => 'index',
    //         'content' => $this->parsedown->text(file_get_contents($file)),
    //         'meta' => $this->parsedown->meta(file_get_contents($file))
    //     ];

    //     $this->assertSame($expected, $markdown);
    // }

    // public function testMarkdownWithFrontMatterSlug()
    // {
    //     $file = './tests/fixtures/content/front-matter-slug.md';
    //     $markdown = $this->collections->markdown($file, $this->collection);
        
    //     $expected = [
    //         'filename' => $file,
    //         'permalink' => '/awesome.html',
    //         'title' => 'We have a slug',
    //         'slug' => 'awesome',
    //         'view' => 'index',
    //         'content' => $this->parsedown->text(file_get_contents($file)),
    //         'meta' => $this->parsedown->meta(file_get_contents($file))
    //     ];

    //     $this->assertSame($expected, $markdown);
    // }

    // public function testMarkdownWithFrontMatterTitle()
    // {
    //     $file = './tests/fixtures/content/front-matter-title.md';
    //     $markdown = $this->collections->markdown($file, $this->collection);
        
    //     $expected = [
    //         'filename' => $file,
    //         'permalink' => '/front-matter-title.html',
    //         'title' => 'Hey',
    //         'slug' => 'front-matter-title',
    //         'view' => 'index',
    //         'content' => $this->parsedown->text(file_get_contents($file)),
    //         'meta' => $this->parsedown->meta(file_get_contents($file))
    //     ];

    //     $this->assertSame($expected, $markdown);
    // }

    // public function testMarkdownWithoutTitle()
    // {
    //     $file = './tests/fixtures/content/front-matter-without-title.md';
    //     $markdown = $this->collections->markdown($file, $this->collection);
        
    //     $expected = [
    //         'filename' => $file,
    //         'permalink' => '/front-matter-without-title.html',
    //         'title' => 'front-matter-without-title',
    //         'slug' => 'front-matter-without-title',
    //         'view' => 'index',
    //         'content' => $this->parsedown->text(file_get_contents($file)),
    //         'meta' => $this->parsedown->meta(file_get_contents($file))
    //     ];

    //     $this->assertSame($expected, $markdown);
    // }

    // public function testMarkdownWithFrontMatterView()
    // {
    //     $file = './tests/fixtures/content/front-matter-view.md';
    //     $markdown = $this->collections->markdown($file, $this->collection);
        
    //     $expected = [
    //         'filename' => $file,
    //         'permalink' => '/front-matter-view.html',
    //         'title' => 'front-matter-view',
    //         'slug' => 'front-matter-view',
    //         'view' => 'cool',
    //         'content' => $this->parsedown->text(file_get_contents($file)),
    //         'meta' => $this->parsedown->meta(file_get_contents($file))
    //     ];

    //     $this->assertSame($expected, $markdown);
    // }

    // public function testMarkdownFrontMatterViewAsSlash()
    // {
    //     $file = './tests/fixtures/content/front-matter-view-slash.md';
    //     $markdown = $this->collections->markdown($file, $this->collection);
        
    //     $expected = [
    //         'filename' => $file,
    //         'permalink' => '/front-matter-view-slash.html',
    //         'title' => 'front-matter-view-slash',
    //         'slug' => 'front-matter-view-slash',
    //         'view' => 'something/another',
    //         'content' => $this->parsedown->text(file_get_contents($file)),
    //         'meta' => $this->parsedown->meta(file_get_contents($file))
    //     ];

    //     $this->assertSame($expected, $markdown);
    // }

    // public function testMarkdownFrontMatterViewAsDot()
    // {
    //     $file = './tests/fixtures/content/front-matter-view-dot.md';
    //     $markdown = $this->collections->markdown($file, $this->collection);
        
    //     $expected = [
    //         'filename' => $file,
    //         'permalink' => '/front-matter-view-dot.html',
    //         'title' => 'front-matter-view-dot',
    //         'slug' => 'front-matter-view-dot',
    //         'view' => 'something/another',
    //         'content' => $this->parsedown->text(file_get_contents($file)),
    //         'meta' => $this->parsedown->meta(file_get_contents($file))
    //     ];

    //     $this->assertSame($expected, $markdown);
    // }

    // public function testMarkdownFileNameSameNameAsView()
    // {
    //     $file = './tests/fixtures/content/cool.md';
    //     $markdown = $this->collections->markdown($file, $this->collection);
        
    //     $expected = [
    //         'filename' => $file,
    //         'permalink' => '/cool.html',
    //         'title' => 'Hey',
    //         'slug' => 'cool',
    //         'view' => 'cool',
    //         'content' => $this->parsedown->text(file_get_contents($file)),
    //         'meta' => $this->parsedown->meta(file_get_contents($file))
    //     ];

    //     $this->assertSame($expected, $markdown);
    // }

    // public function testHtmlFileNameSameNameAsView()
    // {
    //     $file = './tests/fixtures/content/cool2.html';
    //     $markdown = $this->collections->html($file, $this->collection);
        
    //     $expected = [
    //         'filename' => $file,
    //         'permalink' => '/cool2.html',
    //         'title' => 'cool2',
    //         'slug' => 'cool2',
    //         'view' => 'cool2',
    //         'content' => file_get_contents($file),
    //         'meta' => []
    //     ];

    //     $this->assertSame($expected, $markdown);
    // }

    // public function testHtmlNormal()
    // {
    //     $file = './tests/fixtures/content/html_standard.html';
    //     $markdown = $this->collections->html($file, $this->collection);
        
    //     $expected = [
    //         'filename' => $file,
    //         'permalink' => '/html_standard.html',
    //         'title' => 'html_standard',
    //         'slug' => 'html_standard',
    //         'view' => 'index',
    //         'content' => file_get_contents($file),
    //         'meta' => []
    //     ];

    //     $this->assertSame($expected, $markdown);
    // }
}