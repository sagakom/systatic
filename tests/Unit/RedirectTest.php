<?php

namespace Tests;

use Damcclean\Systatic\Redirects;

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
        $this->assertFileExists('./tests/fixtures/dist/google/index.html');
    }

    public function testCanCompileRedirects()
    {
        $build = $this->redirects->compile([
            'slug' => 'bing',
            'target' => 'https://bing.com',
        ]);

        $this->assertSame(true, $build);
        $this->assertFileExists('./tests/fixtures/dist/bing/index.html');
    }
}
