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

    public function getByFileName($filename)
    {
        $results = [];
        $array = $this->collections->fetch();

        foreach($array as $item) {
            if($item['filename'] == $filename) {
                array_push($results, $item);
            }
        }

        return $results;
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