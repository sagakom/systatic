<?php

namespace Damcclean\Systatic\Collections;

use Damcclean\Systatic\Collections\Collections;

class Query
{
    public function __construct()
    {
        $this->collections = new Collections();
    }

    public function getAll()
    {
        return $this->collections->fetch();
    }

    public function getBySlug()
    {
        $all = $this->collections->fetch();
        
    }
}