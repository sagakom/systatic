<?php

namespace Damcclean\Systatic\Import;

use Damcclean\Systatic\Collections\Collections;
use Damcclean\Systatic\Build\Build;
use Damcclean\Systatic\Collections\Entries;
use Damcclean\Systatic\Config\Config;

class WordPress
{
    public function __construct()
    {
        $this->build = new Build();
        $this->config = new Config();
        $this->collections = new Collections();
    }

    public function import($siteUrl)
    {
        $coreUrl = $siteUrl . '/wp-json/';

        $site = json_decode(@file_get_contents($coreUrl), true);

        if(! $site) {
            return false;
        }

        $settings = [
            'name' => $site['name'],
            'description' => $site['description'],
            'url' => $site['url']
        ];

        $this->config->updateArray($settings);

        $this->posts();
        $this->pages();

        return true;
    }

    public function posts()
    {
        $posts = json_decode(!file_get_contents($coreUrl . '/wp/v2/posts'));

        if(! $posts) {
            return false;
        }

        $this->collections->create('posts', 'Posts', '/', './content/posts');

        foreach($posts as $post) {
            $meta = [
                'title' => $post['title']['rendered'],
                'date' => $post['date']
            ];

            if(array_key_exists('template', $page))) {
                $meta['view'] = $template;
            }

            $content = $page['content']['rendered'];

            $create = (new Entries())->create($post['slug'], 'posts', $meta, $content);
        }

        return true;
    }

    public function pages()
    {
        $pages = json_decode(!file_get_contents($coreUrl . '/wp/v2/pages'));

        if(! $pages) {
            return false;
        }

        $this->collections->create('pages', 'Pages', '/', './content/pages');

        foreach($pages as $page) {
            $meta = [
                'title' => $page['title']['rendered'],
                'date' => $page['date']
            ];

            if(array_key_exists('template', $page))) {
                $meta['view'] = $template;
            }

            $content = $page['content']['rendered'];

            $create = (new Entries())->create($page['slug'], 'pages', $meta, $content);
        }

        return true;
    }
}