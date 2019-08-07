<?php

namespace Tests\Unit;

use Damcclean\Systatic\Parsers\Yaml;
use Tests\TestCase;

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
