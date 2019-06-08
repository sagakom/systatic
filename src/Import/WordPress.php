<?php

namespace Damcclean\Systatic\Import;

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

        $pages = json_decode(file_get_contents($apiUrl . '/pages'), true);

        foreach($pages as $page) {
            $this->createFile($page);
        }

        // $this->build->build();
    }

    public function createFile($page)
    {
        $contents = 
                '---' .
                ' title: "' . $page['title']['rendered'] . '"' .
                ' slug: "' . $page['slug'] . '"' .
                ' excerpt: "' . $page['excerpt']['rendered'] . '"' .
                ' date: "' . $page['date'] . '"' .
                '---' .
                $page['content']['rendered'];

            $filename = $this->config->get('locations.content') . '/' . $page['slug'] . '.md';

            file_put_contents($filename, $contents);
    }
}