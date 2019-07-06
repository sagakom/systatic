<?php

namespace Tests;

use Tests\TestCase;
use Damcclean\Systatic\Build\Redirects;

class RedirectTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->redirects = new Redirects();
    }

    public function testCanConfigureRedirectsFromConfig()
    {
        $build = $this->redirects->build();

        $this->assertSame(true, $build);
        $this->assertFileExists('./tests/fixtures/dist/google.html');
    }

    public function testCanCompileRedirects()
    {
        $build = $this->redirects->compile([
            'slug' => 'bing',
            'target' => 'https://bing.com'
        ]);

        $this->assertSame(true, $build);
        $this->assertFileExists('./tests/fixtures/dist/bing.html');
    }
}