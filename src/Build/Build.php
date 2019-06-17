<?php

namespace Damcclean\Systatic\Build;

use Damcclean\Systatic\Addons\Addons;
use Damcclean\Systatic\Build\Redirects;
use Damcclean\Systatic\Collections\Collections;

class Build
{
    public function __construct()
    {
        $this->addons = new Addons();
        $this->collections = new Collections();
        $this->redirects = new Redirects();
    }

    /*
        Find Markdown and HTMl files to the compiler
    */
    
    public function build()
    {
        $this->addons->beforeBuild();
        $this->collections->collect();
        $this->redirects->build();
        $this->addons->afterBuild();
    }
}
