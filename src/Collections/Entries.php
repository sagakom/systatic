<?php

namespace Damcclean\Systatic\Collections;

use Symfony\Component\Yaml\Yaml;

class Entries
{
    public function __construct()
    {
        $this->remote = new Remote();

        $this->entries = [];
    }

    public function process(array $collection)
    {
        $this->entries = [];

        if (array_key_exists('remote', $collection)) {
            return $this->remote->process($collection);
        }

        $files = collect(find_files($collection['location'], '.md'))->map(function ($file) use ($collection) {
            return (new Markdown())->parse($file, $collection);
        });

        $this->entries = $files;
        return $this->entries;
    }

    public function create(string $slug, string $collectionSlug, array $meta, string $content)
    {
        $collection = (new Collections())->show($collectionSlug);

        $frontMatter = $meta;
        $yamlFrontMatter = Yaml::dump($frontMatter);

        $contents = '---' . PHP_EOL . $yamlFrontMatter . PHP_EOL . '---' . PHP_EOL . $content;

        return (bool) file_write_contents($collection['location'] . '/' . $slug . '.md', $contents);
    }

    public function show(string $slug)
    {
        return collect((new Collections())->get())->each(function ($collection) use ($slug) {
            collect($collection['items'])->where('slug', $slug)->first(function ($entry) {
               return $entry;
            });
        });
    }

    public function getCollectionForEntry(string $slug)
    {
        return collect((new Collections())->get())->each(function ($collection) use ($slug) {
            collect($collection['items'])->where('slug', $slug)->first(function ($entry) use ($collection) {
                unset($collection['items']);
                return $collection;
            });
        });
    }
}
