<?php

namespace Tests\Unit;

use Damcclean\Systatic\Plugins\BaseProvider;
use Illuminate\Filesystem\Filesystem;
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

    /** @test */
    public function can_publish_views()
    {
        (new Filesystem())->delete('./tests/fixtures/views/published.blade.php');

        $views = $this->base->publishViews([
            './tests/fixtures/publish-test.blade.php' => 'published.blade.php'
        ]);

        $this->assertFileExists('./tests/fixtures/views/published.blade.php');
    }
}
