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
    }

    public function collect()
    {
        $data = [];

        collect($this->config->get('collections'))->each(function ($collection, $key) use (&$data) {
            $collection['id'] = $key;

            if (! array_key_exists('view', $collection)) {
                $collection['view'] = null;
            }

            if (! array_key_exists('searchable', $collection)) {
                $collection['searchable'] = null;
            }

            $entries = (new Entries())->process($collection);

            if (array_key_exists('remote', $collection)) {
                unset($collection['remote']);
            }

            $data["{$key}"] = [];
            $data["{$key}"] = array_merge($data["{$key}"], $collection);
            $data["{$key}"]['items'] = $entries;
        });

        $this->store($data);

        collect($this->get())->where('searchable', true)->each(function ($collection) {
            return (new Search())->index($collection['items']);
        });

        collect($this->get())->reject(function ($collection) {
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
        return collect($this->get())->map(function ($collection) {
            unset($collection['items']);
            return $collection;
        })->all();
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
