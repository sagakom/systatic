<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Damcclean\Systatic\Compiler\Compiler;

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

    public function testCanCompileHtmlStandard()
    {
        $compiler = new Compiler();
        $compile = $compiler->html('./tests/site/content/html_standard.html');
        $html = strpos($compile, '<strong>consectetur adipiscing elit</strong>');
        $this->assertSame(true, $compile);
        $this->assertEquals($html, 0);
        $this->assertFileExists('./tests/site/dist/html_standard.html');
    }
}