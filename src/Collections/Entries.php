<?php

namespace Damcclean\Systatic\Collections;

use Symfony\Component\Yaml\Yaml;

class Entries
{
    public function __construct()
    {
        $this->remote = new Remote();
        $this->markdown = new Markdown();

        $this->entries = [];
    }

    public function process($collection, $key)
    {
        $this->entries = [];

        if(strpos($collection['location'], 'http') != false) {
            $entries = json_decode(file_get_contents($collection['location']), true);

            foreach($entries as $entry) {
                $this->parse($entry, $collection);
                array_push($this->entries, $entry);
            }
        } else {
            $markdown = [];

            $markdown = array_merge(
                glob(
                    $collection['location'] . '/*.md',
                    GLOB_BRACE
                ), $markdown);

            $markdown = array_merge(
                glob(
                    $collection['location'] . '/*/*.md',
                    GLOB_BRACE
                ), $markdown);

            $markdown = array_merge(
                glob(
                    $collection['location'] . '/*.markdown',
                    GLOB_BRACE
                ), $markdown);

            $markdown = array_merge(
                glob(
                    $collection['location'] . '/*/*.markdown',
                    GLOB_BRACE
                ), $markdown);

            foreach($markdown as $file) {
                $entry = $this->markdown->parse($file, $collection);
                array_push($this->entries, $entry);
            }
        }

        return $this->entries;
    }

    public function create($slug, $collectionSlug, $meta, $content)
    {
        $collection = (new Collections())->get($collectionSlug);

        $frontMatter = $meta;
        $yamlFrontMatter = Yaml::dump($frontMatter);

        $contents = '---' . PHP_EOL . $yamlFrontMatter . PHP_EOL . '---' . PHP_EOL . $content;

        file_put_contents($collection['location'] . '/' . $slug . '.md', $contents);

        return true;
    }
}