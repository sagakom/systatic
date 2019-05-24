<?php

namespace Damcclean\Systatic\Build;

use Damcclean\Systatic\Build\Redirects;
use Damcclean\Systatic\Compiler\Compiler;
use Damcclean\Systatic\Config\Config;

class Build
{
    public function __construct()
    {
        $this->redirects = new Redirects();
        $this->config = new Config();
        $this->compiler = new Compiler();
    }

    /*
        Find Markdown and HTMl files to the compiler
    */
    
    public function build()
    {
        $markdown = [];

        $markdown = array_merge(glob($this->config->getConfig('contentDir') . '/*.md', GLOB_BRACE), $markdown);
        $markdown = array_merge(glob($this->config->getConfig('contentDir') . '/*/*.md', GLOB_BRACE), $markdown);
        $markdown = array_merge(glob($this->config->getConfig('contentDir') . '/*.markdown', GLOB_BRACE), $markdown);
        $markdown = array_merge(glob($this->config->getConfig('contentDir') . '/*/*.markdown', GLOB_BRACE), $markdown);

        foreach ($markdown as $file) {
            $this->compiler->markdown($file);
        }

        $html = [];

        $html = array_merge(glob($this->config->getConfig('contentDir') . '/*.html', GLOB_BRACE), $html);
        $html = array_merge(glob($this->config->getConfig('contentDir') . '/*/*.html', GLOB_BRACE), $html);

        foreach ($html as $file) {
            $this->compiler->html($file);
        }

        $this->redirects->build();
    }
}
