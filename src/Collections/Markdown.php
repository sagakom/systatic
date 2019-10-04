<?php

namespace Damcclean\Systatic\Collections;

use Damcclean\Systatic\Parsers\Yaml;
use Damcclean\Systatic\Config\Config;
use Damcclean\Systatic\Deciders\View;
use Damcclean\Systatic\Plugins\Compiler;
use Damcclean\Systatic\Deciders\Permalink;
use Damcclean\Systatic\Parsers\ParsedownExtra;

class Markdown
{
    public function __construct()
    {
        $this->config = new Config();
        $this->markdown = new ParsedownExtra();
        $this->yaml = new Yaml();
        $this->compiler = new Compiler();
    }

    public function parse(string $filename, array $collection)
    {
        $contents = file_get_contents($filename);
        $markdown = $this->markdown->parse($contents);
        $frontMatter = $this->yaml->parse($contents);

        $entry['slug'] = basename($filename, '.md');
        $entry['title'] = $entry['slug'];

        if (array_key_exists('title', $frontMatter)) {
            $entry['title'] = $frontMatter['title'];
        }

        if (array_key_exists('slug', $frontMatter)) {
            $entry['slug'] = $frontMatter['slug'];
        }

        $entry['view'] = (new View())->decide($collection, $entry);
        $entry['permalink'] = (new Permalink())->decide($collection, $entry);

        $entry['filename'] = $filename;
        $entry['content'] = $markdown;
        $entry['meta'] = $frontMatter;
        $entry['last_updated'] = filemtime($filename);

        return $entry;
    }
}
