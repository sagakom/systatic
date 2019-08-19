<?php

namespace Tests\Unit;

use Tests\TestCase;
use Damcclean\Systatic\Parsers\Yaml;

class YamlParserTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->yaml = new Yaml();
    }

    public function testCanParseYaml()
    {
        $yaml = file_get_contents('./tests/fixtures/yaml-test.md');

        $parse = $this->yaml->parse($yaml);

        $this->assertIsArray($parse);
        $this->assertArrayHasKey('today', $parse);
        $this->assertArrayNotHasKey('Keep', $parse);
    }
}
