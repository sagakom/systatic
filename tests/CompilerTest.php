<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Thunderbird\Compiler\Compiler;

class CompilerTest extends TestCase
{
    public function testCanCompileMarkdownWithFrontMatter()
    {  
        $compiler = new Compiler();
        $compile = $compiler->markdown('./content/tests/markdown_with_frontmatter.md');
        $this->assertSame(true, $compile);
        $this->assertFileExists('dist/markdown_with_frontmatter.html');
    }

    public function testCanCompileMarkdownWithoutFrontmatter()
    {
        $compiler = new Compiler();
        $compile = $compiler->markdown('./content/tests/markdown_without_frontmatter.md');
        $this->assertSame(true, $compile);
        $this->assertFileExists('dist/markdown_without_frontmatter.html');
    }

    public function testCanCompileMarkdownWithHtmlCodeInside()
    {
        $compiler = new Compiler();
        $compile = $compiler->markdown('./content/tests/markdown_with_html_inside.md');
        $html = strpos($compile, '<span class="awesome"><strong>Awesome</strong></span>');
        $this->assertSame(true, $compile);
        $this->assertEquals($html, 0);
        $this->assertFileExists('dist/markdown_with_html_inside.html');
    }
}