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

    public function getBySlug($slug)
    {
        $results = [];
        $array = $this->collections->fetch();

        foreach($array as $item) {
            if($item['slug'] == $slug) {
                array_push($results, $item);
            }
        }

        return $results;
    }
}