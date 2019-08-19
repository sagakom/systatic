<?php

namespace Tests\Unit;

use Damcclean\Systatic\Plugins\BaseProvider;
use Tests\TestCase;

class BasePluginProviderTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->base = new BaseProvider();
    }

    /** @test */
    public function can_register_console()
    {
        $class = \Tests\fixtures\plugins\PluginConsole::class;

        $console = $this->base->registerConsole($class);

        $this->assertIsArray($console);
        $this->assertFileExists('./tests/fixtures/storage/console.json');
    }

    /** @test */
    public function can_register_compiler()
    {
        $class = \Tests\fixtures\plugins\PluginCompiler::class;

        $compiler = $this->base->registerCompiler($class);

        $this->assertIsArray($compiler);
        $this->assertFileExists('./tests/fixtures/storage/compiler.json');
    }
}
