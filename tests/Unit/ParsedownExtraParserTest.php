<?php

namespace Tests\Unit;

use Tests\TestCase;
use Damcclean\Systatic\Parsers\ParsedownExtra;

class ParsedownExtraParserTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->parser = new ParsedownExtra();
    }

    public function testCanParseMarkdownContents()
    {
        $markdown = '# This is my **heading**';

        $parser = $this->parser->parse($markdown);

        $this->assertSame('<h1>This is my <strong>heading</strong></h1>', $parser);
    }

    public function testCanParseMarkdownContentsWithFrontMatter()
    {
        $markdown = file_get_contents('./tests/fixtures/yaml-test.md');

        $parser = $this->parser->parse($markdown);

        $this->assertSame('<p>Keep these dates in your diary!</p>', $parser);
    }
}
