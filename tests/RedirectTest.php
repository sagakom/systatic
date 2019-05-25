<?php

namespace Tests;

use Tests\TestCase;
use Damcclean\Systatic\Build\Redirects;

class RedirectTest extends TestCase
{
    public function setUp(): void
    {
        $this->redirects = new Redirects();
    }

    /*
        Test that we can configure redirects from the config
    */

    public function testCanConfigureRedirectsFromConfig()
    {
        $build = $this->redirects->build();
        $this->assertSame(true, $build);
        $this->assertFileExists('./tests/site/dist/google.html');
    }

    /*
        Test that we can compile redirects
    */

    public function testCanCompileRedirects()
    {
        $build = $this->redirects->compile([
            'slug' => 'bing',
            'target' => 'https://bing.com'
        ]);
        $this->assertSame(true, $build);
        $this->assertFileExists('./tests/site/dist/bing.html');
    }
}