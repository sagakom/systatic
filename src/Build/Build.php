<?php

namespace Thunderbird\Build;

use Thunderbird\Compiler\Compiler;
use Thunderbird\Config\Config;

class Build
{
    public function __construct()
    {
        $this->config = new Config();
        $this->compiler = new Compiler();
    }

    public function build()
    {
        // Create an empty array to store files
        $files = array();

        // Get files to send to compiler
        $files = array_merge(glob($this->config->getConfig('contentDir') . '/*.md', GLOB_BRACE), $files);
        $files = array_merge(glob($this->config->getConfig('contentDir') . '/*/*.md', GLOB_BRACE), $files);

        // Compile each of the files
        foreach($files as $file)
        {
            $this->compiler->compile($file);
        }

        return true;
    }
}