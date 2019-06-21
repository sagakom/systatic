<?php

namespace Damcclean\Systatic\Import;

use Symfony\Component\Yaml\Yaml;
use Damcclean\Systatic\Build\Build;
use Damcclean\Systatic\Config\Config;

class WordPress
{
    public function __construct()
    {
        $this->config = new Config();
        $this->build = new Build();
    }

    public function import($baseUrl)
    {
        $apiUrl = $baseUrl . '/wp-json/wp/v2';

        $pages = json_decode(@file_get_contents($apiUrl . '/pages'), true);
        $posts = json_decode(@file_get_contents($apiUrl . '/posts'), true);

        if(!$pages || !$posts) {
            return false;
        }

        foreach($pages as $page) {
            $this->createFile($page);
        }

        foreach($posts as $post) {
            $this->createFile($post);
        }

        $this->build->build();

        return true;
    }

    public function createFile($page)
    {
        // $frontMatter = [
        //     'title' => $page['title']['rendered'],
        //     'slug' => $page['slug'],
        //     'excerpt' => $page['excerpt']['rendered'],
        //     'date' => $page['date']
        // ];

        // $contents = '---' . Yaml::dump($frontMatter) . '---' . $page['content']['rendered'];
        // $filename = $this->config->get('locations.content') . '/' . $page['slug'] . '.md';

        // file_put_contents($filename, $contents);
    }
}