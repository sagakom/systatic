<?php

namespace Damcclean\Systatic\Collections;

use Damcclean\Systatic\Cache\Cache;
use Damcclean\Systatic\Config\Config;
use Damcclean\Systatic\Compiler\Compiler;
use Damcclean\Systatic\Store;

class Collections extends Store
{
    public $name = 'collections';
    protected $collectionData = [];

    public function __construct()
    {
        parent::__construct();

        $this->cache = new Cache();
        $this->config = new Config();
        $this->entries = new Entries();
        $this->compiler = new Compiler();
    }

    public function collect()
    {
        $collections = $this->config->get('collections');

        foreach ($collections as $key => $collection) {
            $collection['key'] = $key;

            if (! array_key_exists('view', $collection)) {
                $collection['view'] = null;
            }

            if (! array_key_exists('searchable', $collection)) {
                $collection['searchable'] = false;
            }

            $entries = $this->entries->process($collection);

            $this->collectionData["{$key}"] = [];
            $this->collectionData["{$key}"] = array_merge($this->collectionData["{$key}"], $collection);
            $this->collectionData["{$key}"]['items'] = $entries;

            if (array_key_exists('remote', $this->collectionData["{$key}"])) {
                unset($this->collectionData["{$key}"]['remote']);
            }
        }

        $this->store($this->collectionData);

        foreach ($this->collectionData as $collection) {
            if (array_key_exists('searchable', $collection)) {
                if ($collection['searchable'] != false) {
                    (new Search)->index($collection['items']);
                }
            }

            foreach ($collection['items'] as $entry) {
                if (array_key_exists('build', $collection)) {
                    if (! $collection['build'] == false) {
                        $this->compiler->compile($entry);
                        $this->cache->clearViewCache();
                    }
                } else {
                    $this->compiler->compile($entry);
                    $this->cache->clearViewCache();
                }
            }
        }

        return true;
    }

    public function index()
    {
        $collections = [];

        foreach ($this->get() as $collection) {
            unset($collection['items']);

            $collections[] = $collection;
        }

        return $collections;
    }

    public function create(string $slug, string $name, string $permalink, string $location, bool $searchable = null)
    {
        if (array_key_exists('collections', $this->config->getArray())) {
            $collection['collections'] = $this->config->getArray()['collections'];
        } else {
            $collection['collections'] = [];
        }

        $collection['collections']["{$slug}"] = [
            'name' => $name,
            'permalink' => $permalink,
            'location' => $location,
        ];

        if ($searchable != null) {
            $collection["{$slug}"]['searchable'] = $searchable;
        }

        if (! file_exists($location)) {
            $this->filesytem->createDirectory($location);
        }

        return $this->config->updateArray($collection);
    }

    public function show($slug)
    {
        return $this->fetch()["{$slug}"];
    }
}
