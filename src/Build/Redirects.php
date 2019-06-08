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
        if(array_key_exists('redirects', $this->config->getArray())) {
            foreach($this->config->getArray()['redirects'] as $redirect) {
                return $this->compile($redirect);
            }
        }

        return false;
    }

    /*
        Compile redirects to HTMl files
    */

    public function compile($redirect)
    {
        $slug = $redirect['slug'];
        $target = $redirect['target'];

        $contents = '<meta http-equiv="refresh" content="0; URL=\'' . $target . '\'" />';
        file_put_contents($this->config->get('locations.output') . '/' . $slug . '.html', $contents);

        return true;
    }
}