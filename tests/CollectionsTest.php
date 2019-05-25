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
            'title' => 'front-matter-view.md',
            'slug' => 'front-matter-title',
            'view' => 'another',
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
            'title' => 'front-matter-view-slash.md',
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
            'title' => 'front-matter-view-dot.md',
            'slug' => 'front-matter-view-dot',
            'view' => 'something/another',
            'content' => $this->parsedown->text(file_get_contents($file)),
            'meta' => $this->parsedown->meta(file_get_contents($file))
        ];

        $this->assertSame($expected, $markdown);
    }

    public function testMarkdownFileNameSameNameAsView()
    {
        $file = './tests/site/content/another.md';
        $markdown = $this->collections->markdown($file);
        
        $expected = [
            'filename' => $file,
            'title' => 'Hey',
            'slug' => 'another',
            'view' => 'another',
            'content' => $this->parsedown->text(file_get_contents($file)),
            'meta' => $this->parsedown->meta(file_get_contents($file))
        ];

        $this->assertSame($expected, $markdown);
    }

    public function testHtmlFileNameSameNameAsView()
    {
        $file = './tests/site/content/another.html';
        $markdown = $this->collections->html($file);
        
        $expected = [
            'filename' => $file,
            'title' => 'Hey',
            'slug' => 'another',
            'view' => 'another',
            'content' => "<h1>Hey</h1>

            Content",
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
            'title' => 'html_standard.html',
            'slug' => 'html_standard',
            'view' => 'index',
            'content' => "<h1>I love Wildlife!!</h1>

            <p>Lorem ipsum dolor sit amet, <strong>consectetur adipiscing elit</strong>. Sed et risus diam. Sed enim ipsum, cursus tristique quam sit amet, porttitor efficitur mauris. Praesent vel maximus erat, eget placerat erat. Suspendisse ultricies neque a mollis finibus. Sed nec lobortis turpis. Nunc elementum orci quis sapien varius, eu lobortis augue lacinia. In at dapibus justo. Duis elementum tempor odio et auctor.</p>
            
            <p>Aenean convallis sed tellus et fermentum. Vivamus vitae risus aliquet, fringilla turpis a, elementum purus. Quisque bibendum ante tellus, ac auctor risus fringilla sit amet. Ut vitae est quis metus vestibulum gravida quis at magna. Duis sagittis eros eget augue laoreet, eu laoreet diam placerat. Morbi vel orci nisl. Cras rhoncus pretium nulla a volutpat.</p>
            
            <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Cras id ex pretium nisl iaculis fringilla a tempor velit. Donec rutrum auctor finibus. Fusce commodo vulputate ligula, in condimentum lorem pharetra non. Fusce ultricies pretium mi eu consectetur. Nam a imperdiet velit. Curabitur sed nulla ac magna posuere ultricies.</p>
            
            <p><a href=\"#\">Proin dui augue</a>, fermentum et pellentesque in, venenatis sit amet lacus. Quisque viverra, dui non suscipit ullamcorper, massa lacus malesuada mi, et ultricies eros nisi in lectus. Etiam vitae ornare nunc, imperdiet eleifend ante. Etiam tortor nisl, ultricies non maximus sed, porta vitae nulla. Praesent ipsum lacus, elementum id maximus in, congue sit amet justo. Vestibulum sit amet nibh ut turpis luctus iaculis a ac quam. Duis quis rutrum turpis, interdum maximus tortor. Sed vitae risus eu odio consectetur semper. Curabitur sodales mattis massa vehicula tempor.</p>
            
            <p>Nullam vel aliquet mi, eu laoreet ante. Aenean ex justo, consequat sit amet velit ut, consequat porta arcu. Nulla pulvinar convallis magna ut hendrerit. In quis turpis volutpat, viverra lacus id, molestie nisi. Nullam scelerisque, libero in tempus egestas, eros lacus fringilla velit, eu suscipit magna orci in ligula. Ut non malesuada enim, a ultricies quam. Aliquam sodales porta ultricies.</p>",
            'meta' => []
        ];

        $this->assertSame($expected, $markdown);
    }
}