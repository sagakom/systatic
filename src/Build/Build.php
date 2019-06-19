<?php

namespace Damcclean\Systatic\Build;

use Damcclean\Systatic\Plugins\Plugins;
use Damcclean\Systatic\Build\Redirects;
use Damcclean\Systatic\Collections\Collections;

class Build
{
    public function __construct()
    {
        $this->plugins = new Plugins();
        $this->collections = new Collections();
        $this->redirects = new Redirects();
    }

    /*
        Find Markdown and HTMl files to the compiler
    */
    
    public function build()
    {
        $this->plugins->beforeBuild();
        $this->collections->collect();
        $this->redirects->build();
        $this->plugins->afterBuild();
    }
}
