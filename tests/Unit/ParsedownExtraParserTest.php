<?php

namespace Tests\Unit;

use Damcclean\Systatic\Parsers\ParsedownExtra;
use Tests\TestCase;

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
}
