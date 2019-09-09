<?php

namespace Damcclean\Systatic\Deciders;

class Permalink
{
    public function decide($collection, $entry)
    {
        if (endsWith($collection['permalink'], '/') != false) {
            $permalink = $collection['permalink'] . $entry['slug'];
        } else {
            $permalink = $collection['permalink'] . '/' . $entry['slug'];
        }

        if ($entry['slug'] != 'index') {
            $permalink = $permalink . '/index.html';
        } else {
            $permalink = $permalink . '.html';
        }

        return $permalink;
    }
}