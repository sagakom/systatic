<?php

namespace Damcclean\Systatic;

use Damcclean\Systatic\Config\Config;

class Store
{
    public function __construct()
    {
        $this->config = new Config();
    }

    public function get()
    {
        return json_decode(
            file_get_contents(
                $this->config->get('locations.storage').'/'.$this->name.'.json'
            )
        );
    }

    /** @ */
    public function store(array $data)
    {
        return (bool) file_put_contents(
            $this->config->get('locations.storage').'/'.$this->name.'.json',
            json_encode($data)
        );
    }
}