<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Damcclean\Systatic\Compiler\Compiler;
use Damcclean\Systatic\Compiler\BladeCompiler;

class CompilerTest extends TestCase
{
    public function testCanCompileMarkdownWithFrontMatter()
    {
        $compiler = new Compiler();
        $compile = $compiler->markdown('./tests/site/content/markdown_with_frontmatter.md');
        $this->assertSame(true, $compile);
        $this->assertFileExists('./tests/site/dist/markdown_with_frontmatter.html');
    }

    public function testCanCompileMarkdownWithoutFrontmatter()
    {
        $compiler = new Compiler();
        $compile = $compiler->markdown('./tests/site/content/markdown_without_frontmatter.md');
        $this->assertSame(true, $compile);
        $this->assertFileExists('./tests/site/dist/markdown_without_frontmatter.html');
    }

    public function testCanCompileMarkdownWithHtmlCodeInside()
    {
        $compiler = new Compiler();
        $compile = $compiler->markdown('./tests/site/content/markdown_with_html_inside.md');
        $html = strpos($compile, '<span class="awesome"><strong>Awesome</strong></span>');
        $this->assertSame(true, $compile);
        $this->assertEquals($html, 0);
        $this->assertFileExists('./tests/site/dist/markdown_with_html_inside.html');
    }

    public function testCanCompileDotMarkdownFileExtension()
    {
        $compiler = new Compiler();
        $compile = $compiler->markdown('./tests/site/content/dot_markdown.markdown');
        $this->assertSame(true, $compile);
        $this->assertFileExists('./tests/site/dist/dot_markdown.html');
    }

    public function testFrontMatterSlug()
    {
        $compiler = new Compiler();
        $compile = $compiler->markdown('./tests/site/content/front-matter-slug.md');
        $this->assertSame(true, $compile);
        $this->assertFileExists('./tests/site/dist/awesome.html');
    }

    public function testFrontMatterTitle()
    {
        $compiler = new Compiler();
        $compile = $compiler->markdown('./tests/site/content/front-matter-title.md');
        $title = strpos($compile, '<title>Hey</title>');
        $this->assertSame(true, $compile);
        $this->assertEquals($title, 0);
        $this->assertFileExists('./tests/site/dist/front-matter-title.html');
    }

    public function testFrontMatterWithoutTitle()
    {
        $compiler = new Compiler();
        $compile = $compiler->markdown('./tests/site/content/front-matter-without-title.md');
        $title = strpos($compile, '<title>front-matter-without-title</title>');
        $this->assertSame(true, $compile);
        $this->assertEquals($title, 0);
        $this->assertFileExists('./tests/site/dist/front-matter-without-title.html');
    }

    public function testFrontMatterView()
    {
        $compiler = new Compiler();
        $compile = $compiler->markdown('./tests/site/content/front-matter-view.md');
        $title = strpos($compile, '<meta name="description" content="another view">');
        $this->assertSame(true, $compile);
        $this->assertEquals($title, 0);
        $this->assertFileExists('./tests/site/dist/front-matter-view.html');
    }

    public function testContentSameNameAsView()
    {
        $compiler = new Compiler();
        $compile = $compiler->markdown('./tests/site/content/another.md');
        $title = strpos($compile, '<meta name="description" content="another view">');
        $this->assertSame(true, $compile);
        $this->assertEquals($title, 0);
        $this->assertFileExists('./tests/site/dist/another.html');
    }

    public function testCanCompileHtmlStandard()
    {
        $compiler = new Compiler();
        $compile = $compiler->html('./tests/site/content/html_standard.html');
        $html = strpos($compile, '<strong>consectetur adipiscing elit</strong>');
        $this->assertSame(true, $compile);
        $this->assertEquals($html, 0);
        $this->assertFileExists('./tests/site/dist/html_standard.html');
    }

    public function testHtmlContentFileSameNameAsView()
    {
        $compiler = new Compiler();
        $compile = $compiler->html('./tests/site/content/another.html');
        $title = strpos($compile, '<meta name="description" content="another view">');
        $this->assertSame(true, $compile);
        $this->assertEquals($title, 0);
        $this->assertFileExists('./tests/site/dist/another.html');
    }

    public function testBladeCompiler()
    {
        $blade = new BladeCompiler();

        $blade->compile([
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
}