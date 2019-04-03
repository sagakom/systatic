<?php

namespace Damcclean\Systatic\Build;

use Damcclean\Systatic\Compiler\Compiler;
use Damcclean\Systatic\Config\Config;

class Build
{
    public function __construct()
    {
        $this->config = new Config();
        $this->compiler = new Compiler();
    }

    public function build()
    {
        // Create an empty array to store markdown files
        $markdown = array();

        // Get files to send to compiler
        $markdown = array_merge(glob($this->config->getConfig('contentDir') . '/*.md', GLOB_BRACE), $markdown);
        $markdown = array_merge(glob($this->config->getConfig('contentDir') . '/*/*.md', GLOB_BRACE), $markdown);
        $markdown = array_merge(glob($this->config->getConfig('contentDir') . '/*.markdown', GLOB_BRACE), $markdown);
        $markdown = array_merge(glob($this->config->getConfig('contentDir') . '/*/*.markdown', GLOB_BRACE), $markdown);

        // Compile each of the files
        foreach($markdown as $file)
        {
            $this->compiler->markdown($file);
        }

        // Create an empty array to store html files
        $html = array();

        // Get files to send to compiler
        $html = array_merge(glob($this->config->getConfig('contentDir') . '/*.html', GLOB_BRACE), $html);
        $html = array_merge(glob($this->config->getConfig('contentDir') . '/*/*.html', GLOB_BRACE), $html);

        // Compile each of the files
        foreach($html as $file)
        {
            $this->compiler->html($file);
        }

        return true;
    }
}