<?php

namespace Damcclean\Systatic;

use Damcclean\Systatic\Config\Config;
use Illuminate\Filesystem\Filesystem;

class Store
{
    public function __construct()
    {
        $this->config = new Config();
    }

    public function prep()
    {
        if (! file_exists($this->config->get('locations.storage').'/'.$this->name.'.json')) {
            (new Filesystem())->put($this->config->get('locations.storage').'/'.$this->name.'.json', '{}');
        }
    }

    public function get()
    {
        $this->prep();

        return json_decode(
            file_get_contents(
                $this->config->get('locations.storage').'/'.$this->name.'.json'
            ),
            true
        );
    }

    public function store(array $data)
    {
        $this->prep();

        return (bool) file_put_contents(
            $this->config->get('locations.storage').'/'.$this->name.'.json',
            json_encode($data)
        );
    }
}
