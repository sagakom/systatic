<?php

namespace Damcclean\Systatic\Collections;

use Symfony\Component\Yaml\Yaml;

class Entries
{
    public function __construct()
    {
        $this->remote = new Remote();
        $this->markdown = new Markdown();

        $this->store = [];
    }

    public function process($collection, $key)
    {
        if(strpos($collection['location'], 'http') != false) {
            $entries = json_decode(file_get_contents($collection['location']), true);

            foreach($entries as $entry) {
                $this->parse($entry, $collection);
                array_push($this->store, $entry);
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
                array_push($this->store, $entry);
            }
        }

        return $this->store;
    }

    public function create($slug, $collectionSlug, $meta, $content)
    {
        $collection = (new Collections())->get($collectionSlug);

        $frontMatter = $meta;
        $yamlFrontMatter = Yaml::dump($frontMatter);

        $contents = '---\n' . $yamlFrontMatter . '\n---' . $content;

        file_put_contents($collection['location'], $contents);

        return true;
    }
}