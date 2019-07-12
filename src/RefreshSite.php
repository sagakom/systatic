<?php

namespace Damcclean\Systatic;

use Damcclean\Systatic\Cache\Cache;

trait RefreshSite
{
    public function refreshSite()
    {
        $cache = new Cache();
        $cache->clearEverything();
        $cache->clearSiteOutput();
    }
}