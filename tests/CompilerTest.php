<?php

namespace Tests;

use Tests\TestCase;
use Damcclean\Systatic\Compiler\Compiler;
use Damcclean\Systatic\Compiler\BladeCompiler;

class CompilerTest extends TestCase
{
    public function setUp(): void
    {
        $this->compiler = new Compiler();
        $this->blade = new BladeCompiler();
    }

    public function testCanCompileMarkdownWithFrontMatter()
    {
        $compile = $this->compiler->markdown('./tests/site/content/markdown_with_frontmatter.md');
        $this->assertSame(true, $compile);
        $this->assertFileExists('./tests/site/dist/markdown_with_frontmatter.html');
    }

    public function testCanCompileMarkdownWithoutFrontmatter()
    {
        $compile = $this->compiler->markdown('./tests/site/content/markdown_without_frontmatter.md');
        $this->assertSame(true, $compile);
        $this->assertFileExists('./tests/site/dist/markdown_without_frontmatter.html');
    }

    public function testCanCompileMarkdownWithHtmlCodeInside()
    {
        $compile = $this->compiler->markdown('./tests/site/content/markdown_with_html_inside.md');
        $html = strpos($compile, '<span class="awesome"><strong>Awesome</strong></span>');
        $this->assertSame(true, $compile);
        $this->assertEquals($html, 0);
        $this->assertFileExists('./tests/site/dist/markdown_with_html_inside.html');
    }

    public function testCanCompileDotMarkdownFileExtension()
    {
        $compile = $this->compiler->markdown('./tests/site/content/dot_markdown.markdown');
        $this->assertSame(true, $compile);
        $this->assertFileExists('./tests/site/dist/dot_markdown.html');
    }

    public function testFrontMatterSlug()
    {
        $compile = $this->compiler->markdown('./tests/site/content/front-matter-slug.md');
        $this->assertSame(true, $compile);
        $this->assertFileExists('./tests/site/dist/awesome.html');
    }

    public function testFrontMatterTitle()
    {
        $compile = $this->compiler->markdown('./tests/site/content/front-matter-title.md');
        $title = strpos($compile, '<title>Hey</title>');
        $this->assertSame(true, $compile);
        $this->assertEquals($title, 0);
        $this->assertFileExists('./tests/site/dist/front-matter-title.html');
    }

    public function testFrontMatterWithoutTitle()
    {
        $compile = $this->compiler->markdown('./tests/site/content/front-matter-without-title.md');
        $title = strpos($compile, '<title>front-matter-without-title</title>');
        $this->assertSame(true, $compile);
        $this->assertEquals($title, 0);
        $this->assertFileExists('./tests/site/dist/front-matter-without-title.html');
    }

    public function testFrontMatterView()
    {
        $compile = $this->compiler->markdown('./tests/site/content/front-matter-view.md');
        $title = strpos($compile, '<meta name="description" content="another view">');
        $this->assertSame(true, $compile);
        $this->assertEquals($title, 0);
        $this->assertFileExists('./tests/site/dist/front-matter-view.html');
    }

    public function textFrontMatterViewAsDot()
    {
        $compile = $this->compiler->markdown('./tests/site/content/front-matter-view-dot.md');
        $meta = strpos($compile, '<meta name="description" content="something other">');
        $this->assertSame(true, $compile);
        $this->assertEquals($meta, 0);
        $this->assertFileExists('./tests/site/dist/front-matter-view-dot.html');
    }

    public function textFrontMatterViewAsSlash()
    {
        $compile = $this->compiler->markdown('./tests/site/content/front-matter-view-slash.md');
        $meta = strpos($compile, '<meta name="description" content="something other">');
        $this->assertSame(true, $compile);
        $this->assertEquals($meta, 0);
        $this->assertFileExists('./tests/site/dist/front-matter-view-slash.html');
    }

    public function testContentSameNameAsView()
    {
        $compile = $this->compiler->markdown('./tests/site/content/another.md');
        $title = strpos($compile, '<meta name="description" content="another view">');
        $this->assertSame(true, $compile);
        $this->assertEquals($title, 0);
        $this->assertFileExists('./tests/site/dist/another.html');
    }

    public function testCanCompileHtmlStandard()
    {
        $compile = $this->compiler->html('./tests/site/content/html_standard.html');
        $html = strpos($compile, '<strong>consectetur adipiscing elit</strong>');
        $this->assertSame(true, $compile);
        $this->assertEquals($html, 0);
        $this->assertFileExists('./tests/site/dist/html_standard.html');
    }

    public function testHtmlContentFileSameNameAsView()
    {
        $compile = $this->compiler->html('./tests/site/content/another.html');
        $title = strpos($compile, '<meta name="description" content="another view">');
        $this->assertSame(true, $compile);
        $this->assertEquals($title, 0);
        $this->assertFileExists('./tests/site/dist/another.html');
    }

    public function testBladeCompiler()
    {
        $this->blade->compile([
            'view' => 'index',
            'slug' => 'i-love-bananas',
            'title' => 'I love Bananas!!!',
            'content' => '<p>Bananas are my favourite thing to eat. I wish I could eat them for breakfast, lunch and dinner.</p>',
            'matter' => [
                'title' => 'I love Bananas!!!'
            ]
        ]);

        $this->assertFileExists('./tests/site/dist/i-love-bananas.html');
    }

    public function testBladeCompilerWithHtmlView()
    {
        $this->blade->compile([
            'view' => 'this-is-cool',
            'slug' => 'i-love-apples',
            'title' => 'I love Apples!!!',
            'content' => '<p>Apples are my favourite thing to eat. I wish I could eat them for breakfast, lunch and dinner.</p>',
            'matter' => [
                'title' => 'I love Apples!!!'
            ]
        ]);

        $this->assertFileExists('./tests/site/dist/i-love-apples.html');
    }
}