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

    public function testBladeCompiler()
    {
        $this->blade->compile([
            'view' => 'index',
            'slug' => 'i-love-bananas',
            'title' => 'I love Bananas!!!',
            'content' => '<p>Bananas are my favourite thing to eat. I wish I could eat them for breakfast, lunch and dinner.</p>',
            'matter' => [
                'title' => 'I love Bananas!!!'
            ]
        ]);

        $this->assertFileExists('./tests/site/dist/i-love-bananas.html');
    }

    public function testBladeCompilerWithHtmlView()
    {
        $this->blade->compile([
            'view' => 'this-is-cool',
            'slug' => 'i-love-apples',
            'title' => 'I love Apples!!!',
            'content' => '<p>Apples are my favourite thing to eat. I wish I could eat them for breakfast, lunch and dinner.</p>',
            'matter' => [
                'title' => 'I love Apples!!!'
            ]
        ]);

        $this->assertFileExists('./tests/site/dist/i-love-apples.html');
    }
}