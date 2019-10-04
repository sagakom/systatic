<?php

namespace Damcclean\Systatic\Deciders;

use Damcclean\Systatic\Config\Config;
use Damcclean\Systatic\Plugins\Compiler;

class View
{
    public function __construct()
    {
        $this->config = new Config();
    }

    public function decide($collection, $entry)
    {
        $view = 'index';

        if (array_key_exists('view', $collection)) {
            foreach ((new Compiler())->getExtensions() as $extension) {
                $file = $this->config->get('locations.views').'/'.$collection['view'].$extension;

                if (file_exists($file)) {
                    $view = basename($file, $extension);
                }
            }
        }

        if (array_key_exists('slug', $entry)) {
            foreach ((new Compiler())->getExtensions() as $extension) {
                $file = $this->config->get('locations.views').'/'.$entry['slug'].$extension;

                if (file_exists($file)) {
                    $view = basename($file, $extension);
                }
            }
        }

        if (array_key_exists('view', $entry)) {
            foreach ((new Compiler())->getExtensions() as $extension) {
                $file = $this->config->get('locations.views').'/'.str_replace('.', '/', $entry['view']).$extension;

                if (file_exists($file)) {
                    $view = basename($file, $extension);
                }
            }
        }

        return $view;
    }
}
