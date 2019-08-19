<?php

namespace Damcclean\Systatic\Plugins;

use Damcclean\Systatic\Store;

class Compiler extends Store
{
    public $name = 'compiler';

    public function add(array $data)
    {
        $this->store($data);
        return $this->get();
    }
}