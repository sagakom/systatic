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
        if(array_key_exists('redirects', $this->config->getArray())) {
            foreach($this->config->getArray()['redirects'] as $redirect) {
                return $this->compile($redirect);
            }
        }

        return false;
    }

    public function compile($redirect)
    {
        $slug = $redirect['slug'];
        $target = $redirect['target'];

        $contents = '<meta http-equiv="refresh" content="0; URL=\'' . $target . '\'" />';
        file_write_contents($this->config->get('locations.output') . '/' . $slug . '/index.html', $contents);

        return true;
    }
}
