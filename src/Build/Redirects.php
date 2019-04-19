<?php

namespace Damcclean\Systatic\Build;

use Damcclean\Systatic\Config\Config;

class Redirects
{
    public function __construct()
    {
        $this->config = new Config();
    }

    public function build()
    {
        $configArray = $this->config->getConfigArray();
        if(array_key_exists('redirects', $configArray)) {
            foreach($configArray['redirects'] as $slug => $redirect) {
                $item = [
                    'slug' => $slug,
                    'target' => $redirect
                ];
    
                $this->compile($item);
            }
    
            return true;
        } else {
            return true;
        }
    }

    public function compile($redirect)
    {
        $slug = $redirect['slug'];
        $target = $redirect['target'];

        $contents = '<meta http-equiv="refresh" content="0; URL=\'' . $target . '\'" />';
        file_put_contents($this->config->getConfig('outputDir') . '/' . $slug . '.html', $contents);

        return true;
    }
}