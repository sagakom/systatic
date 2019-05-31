<?php

namespace Damcclean\Systatic\Build;

use Damcclean\Systatic\Config\Config;

class Redirects
{
    public function __construct()
    {
        $this->config = new Config();
    }

    /*
        Find redirects and send them to be compiled
    */

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

    /*
        Compile redirects to HTMl files
    */

    public function compile($redirect)
    {
        $slug = $redirect['slug'];
        $target = $redirect['target'];

        $contents = '<meta http-equiv="refresh" content="0; URL=\'' . $target . '\'" />';
        file_put_contents($this->config->getConfig('locations.output') . '/' . $slug . '.html', $contents);

        return true;
    }
}