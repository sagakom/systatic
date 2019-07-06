<?php

namespace Damcclean\Systatic\Compiler;

use Damcclean\Systatic\Config\Config;
use Tightenco\Collect\Support\Collection;
use Damcclean\Systatic\Collections\Collections;

class Page
{
    public function __construct()
    {
        $this->config = new Config();
    }

    public function process($data)
    {
        $page = [
            'url' => $this->config->get('url') . $data['slug'] . '/index.html',
            'filename' => $data['filename'],
            'permalink' => $data['permalink'],

            'title' => $data['title'],
            'slug' => $data['slug'],
            'view' => $data['view'],
            'content' => $data['content'],
            'last_updated' => $data['last_updated'],
            'meta' => convert_to_object($data['meta']),

            'config' => convert_to_object($this->config->getArray()),
        ];

        foreach((new Collections())->fetch() as $collection) {
            $page["{$collection['key']}"] = collect($collection['items']);

            foreach($page["{$collection['key']}"] as $key => $value) {
                $page["{$collection['key']}"]["{$key}"] = convert_to_object($value);
            }
        }

        return $page;
    }
}