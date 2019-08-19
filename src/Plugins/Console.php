<?php

namespace Damcclean\Systatic\Plugins;

use Damcclean\Systatic\Store;

class Console extends Store
{
    public $name = 'console';

    public function add(array $data)
    {
        $this->store($data);
        return $this->get();
    }
}