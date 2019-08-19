<?php

namespace Tests;

use Damcclean\Systatic\Compiler\BladeCompiler;
use Damcclean\Systatic\Collections\Collections;

class BladeCompilerTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->blade = new BladeCompiler();
        $this->collections = new Collections();
    }

    public function testCanUseBladeCompiler()
    {
        $this->collections->collect();

        $data = [
            'filename' => './tests/fixtures/content/pages/jokes.md',
            'permalink' => '/jokes.html',
            'title' => 'Listen to my jokes',
            'slug' => 'index',
            'view' => 'index',
            'content' => '<p>I have a few jokes for you!</p>',
            'meta' => [
                'title' => 'Listen to my jokes',
            ],
            'last_updated' => null,
        ];

        $blade = $this->blade->compile($data);

        $this->assertTrue($blade);
        $this->assertFileExists('./tests/fixtures/dist/jokes.html');
    }
}
