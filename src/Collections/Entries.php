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

    public function process($collection)
    {
        $this->entries = [];

        if (array_key_exists('remote', $collection)) {
            $this->entries = $this->remote->process($collection);
        } else {
            $markdown = [];

            $markdown = array_merge(
                glob(
                    $collection['location'] . '/*.md',
                    GLOB_BRACE
                ),
                $markdown
            );

            $markdown = array_merge(
                glob(
                    $collection['location'] . '/*/*.md',
                    GLOB_BRACE
                ),
                $markdown
            );

            $markdown = array_merge(
                glob(
                    $collection['location'] . '/*.markdown',
                    GLOB_BRACE
                ),
                $markdown
            );

            $markdown = array_merge(
                glob(
                    $collection['location'] . '/*/*.markdown',
                    GLOB_BRACE
                ),
                $markdown
            );

            foreach ($markdown as $file) {
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

        return (bool) file_write_contents($collection['location'] . '/' . $slug . '.md', $contents);
    }

    public function get($slug)
    {
        $collections = (new Collections())->fetch();

        foreach($collections as $collection) {
            foreach($collection['items'] as $entry) {
                if($entry['slug'] == $slug) {
                    return [
                        $entry,
                        $collection
                    ];
                }
            }
        }

        return null;
    }
}
