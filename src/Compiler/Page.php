<?php

namespace Damcclean\Systatic\Compiler;

use Damcclean\Systatic\Config\Config;
use Damcclean\Systatic\Collections\Entries;
use Damcclean\Systatic\Collections\Collections;

class Page
{
    public function __construct()
    {
        $this->config = new Config();
    }

    public function process(array $data)
    {
        $filename = '/' . $data['permalink'];

        if (startsWith($data['permalink'], '/')) {
            $filename = $data['permalink'];
        }

        if (array_key_exists('filetype', $data['meta'])) {
            str_replace('.html', '.' . $data['meta']['filetype'], $filename);
        }

        $collections = new Collections();

        $page = [
            'url' => $this->config->get('url') . $data['slug'] . '/index.html',
            'filename' => $data['filename'],
            'output_filename' => $filename,
            'permalink' => $data['permalink'],
            'title' => $data['title'],
            'slug' => $data['slug'],
            'view' => $data['view'],
            'content' => $data['content'],
            'last_updated' => $data['last_updated'],
            'collection' => convert_to_object((new Entries())->show($data['slug'])),
        ];

        foreach ($collections->index() as $collection) {
            $items = $collections->show($collection['id'])['items'];

            $page["{$collection['id']}"] = collect($items);

            foreach ($page["{$collection['id']}"] as $key => $value) {
                $page["{$collection['id']}"]["{$key}"] = convert_to_object($value);
            }
        }

        foreach ($this->config->getArray() as $key => $value) {
            $page["{$key}"] = convert_to_object($value);
        }

        foreach ($data['meta'] as $key => $value) {
            $page["{$key}"] = convert_to_object($value);
        }

        return $page;
    }
}
