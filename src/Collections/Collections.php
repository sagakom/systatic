<?php

namespace Damcclean\Systatic\Collections;

use Damcclean\Systatic\Cache\Cache;
use Damcclean\Systatic\Config\Config;
use Damcclean\Systatic\Compiler\Compiler;
use Damcclean\Systatic\Filesystem\Filesystem;

class Collections
{
    public function __construct()
    {
        $this->cache = new Cache();
        $this->config = new Config();
        $this->entries = new Entries();
        $this->compiler = new Compiler();
        $this->filesytem = new Filesystem();

        $this->store = [];
    }

    public function collect()
    {
        $collections = $this->config->get('collections');

        foreach($collections as $key => $collection) {
            $collection['key'] = $key;

            if(!array_key_exists('view', $collection)) {
                $collection['view'] = null;
            }

            if(!array_key_exists('searchable', $collection)) {
                $collection['searchable'] = false;
            }

            $entries = $this->entries->process($collection, $key);

            $this->store["{$key}"] = [];
            $this->store["{$key}"] = array_merge($this->store["{$key}"], $collection);
            $this->store["{$key}"]['items'] = $entries;
        }

        $this->save($this->store);

        foreach($this->store as $collection) {
            if(array_key_exists('searchable', $collection)) {
                if($collection['searchable'] != false) {
                    (new Search)->index($collection['items']);
                }   
            }

            foreach($collection['items'] as $entry) {
                $this->compiler->compile($entry);
                $this->cache->clearViewCache();
            }
        }

        return true;
    }

    public function save($store)
    {
        file_put_contents($this->config->get('locations.storage') . '/collections.json', json_encode($store));
        return true;
    }

    public function fetch()
    {
        return json_decode(file_get_contents($this->config->get('locations.storage') . '/collections.json'), true);
    }

    public function fetchAsJson()
    {
        return file_get_contents($this->config->get('locations.storage') . '/collection.json');
    }

    public function create($name, $permalink, $location, $searchable = null)
    {
        $slug = strtolower($name);

        $collection['collections'] = $this->config->getArray()['collections'];
        $collection['collections']["{$slug}"] = [
            'name' => $name,
            'permalink' => $permalink,
            'location' => $location
        ];

        if($searchable != null) {
            $collection["{$slug}"]['searchable'] = $searchable;
        }

        if(! file_exists($location)) {
            $this->filesytem->createDirectory($location);
        }

        return $this->config->updateArray($collection);
    }

    public function get($slug)
    {
        return $this->fetch()["{$slug}"];
    }
}