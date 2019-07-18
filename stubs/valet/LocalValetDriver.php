<?php

class LocalValetDriver extends BasicValetDriver
{
    public function mutateUri($uri)
    {
        return rtrim('/dist' . $uri, '/');
    }

    public function serves($sitePath, $siteName, $uri)
    {
        return is_dir($sitePath . '/dist');
    }
}
