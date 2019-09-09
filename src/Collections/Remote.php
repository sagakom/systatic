<?php

namespace Damcclean\Systatic\Collections;

use Carbon\Carbon;
use Damcclean\Systatic\Config\Config;
use Damcclean\Systatic\Deciders\LastUpdated;
use Damcclean\Systatic\Deciders\Permalink;
use Damcclean\Systatic\Deciders\View;
use Damcclean\Systatic\Plugins\Compiler;

class Remote
{
    protected $entries = [];

    public function __construct()
    {
        $this->config = new Config();
        $this->compiler = new Compiler();
    }

    public function process(array $collection)
    {
        return collect($collection['remote']())->map(function ($item) use ($collection) {
            return $this->parse($item, $collection);
        })->all();
    }

    public function parse(array $entry, array $collection)
    {
        $view = (new View())->decide($collection, $entry);
        $permalink = (new Permalink())->decide($collection, $entry);

        $lastUpdated = Carbon::now();

        if (array_key_exists('last_updated', $entry)) {
            $lastUpdated = $entry['last_updated'];
        }

        return [
            'filename' => $entry['slug'],
            'permalink' => $permalink,
            'title' => $entry['title'],
            'slug' => $entry['slug'],
            'view' => $view,
            'content' => $entry['content'],
            'meta' => $entry,
            'last_updated' => $lastUpdated,
        ];
    }
}
