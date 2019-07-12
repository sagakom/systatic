<?php

namespace Damcclean\Systatic\Build;

use Damcclean\Systatic\Cache\Cache;
use Damcclean\Systatic\Build\Redirects;
use Damcclean\Systatic\Collections\Collections;

class Build
{
    public function __construct()
    {
        $this->cache = new Cache();
        $this->redirects = new Redirects();
        $this->collections = new Collections();
    }
    
    public function build()
    {
        $this->collections->collect();
        $this->redirects->build();
        $this->cache->clearStoreCache();
    }
}
