<?php

namespace Damcclean\Systatic\Collections;

use Damcclean\Systatic\Store;
use Damcclean\Systatic\Cache\Cache;
use Damcclean\Systatic\Config\Config;
use Illuminate\Filesystem\Filesystem;
use Damcclean\Systatic\Compiler\Compiler;

class Collections extends Store
{
    public $name = 'collections';
    protected $collectionData = [];

    public function __construct()
    {
        parent::__construct();

        $this->config = new Config();
        $this->entries = new Entries();

        $this->collectionData = [];
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

        collect($this->collectionData)->where('searchable', true)->each(function ($collection) {
            return (new Search())->index($collection['items']);
        });

        collect($this->collectionData)->reject(function ($collection) {
            if (array_key_exists('build', $collection)) {
                return $collection['build'] === false;
            }

            return false;
        })->each(function ($collection) {
            collect($collection['items'])->each(function ($entry) {
                (new Compiler())->compile($entry);
                (new Cache())->clearViewCache();
            });
        });

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
            (new Filesystem())->makeDirectory($location);
        }

        return $this->config->updateArray($collection);
    }

    public function show(string $slug)
    {
        return $this->get()["{$slug}"];
    }
}
