<?php

namespace Tests;

use Tests\TestCase;
use Damcclean\Systatic\Compiler\BladeCompiler;

class CompilerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->blade = new BladeCompiler();
    }

    public function testBladeCompilerWithBladePhpView()
    {
        $this->blade->compile([
            'filename' => 'banana.html',
            'permalink' => '/banana.html',
            'title' => 'I love Bananas!',
            'slug' => 'banana',
            'view' => 'index',
            'content' => '<p>Bananas are my favourite thing to eat. I wish I could eat them for breakfast, lunch and dinner.</p>',
            'meta' => []
        ]);

        $this->assertFileExists('./tests/fixtures/dist/banana.html');
    }

    public function testBladeCompilerWithHtmlView()
    {
        $this->blade->compile([
            'filename' => 'apple.html',
            'permalink' => '/apple.html',
            'title' => 'I love Apples!',
            'slug' => 'apple',
            'view' => 'this-is-cool',
            'content' => '<p>Apples are my favourite thing to eat. I wish I could eat them for breakfast, lunch and dinner.</p>',
            'meta' => []
        ]);

        $this->assertFileExists('./tests/fixtures/dist/apple.html');
    }
}