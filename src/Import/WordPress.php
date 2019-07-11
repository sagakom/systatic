<?php

namespace Damcclean\Systatic\Import;

use Damcclean\Systatic\Collections\Collections;
use Damcclean\Systatic\Collections\Entries;
use Damcclean\Systatic\Config\Config;

class WordPress
{
    public function __construct()
    {
        $this->config = new Config();
        $this->collections = new Collections();
    }

    public function import($siteUrl)
    {
        $coreUrl = $siteUrl . '/wp-json';

        $config = $this->config($coreUrl);
        $posts = $this->posts($coreUrl);
        $pages = $this->pages($coreUrl);

        return true;
    }

    public function config($coreUrl)
    {
        $site = json_decode(@file_get_contents($coreUrl), true);

        if(! $site) {
            return false;
        }

        $settings = [
            'name' => $site['name'],
            'url' => $site['url']
        ];

        if($site['description'] != '') {
            $settings['description'] = $site['description'];
        }

        return $this->config->updateArray($settings);
    }

    public function posts($coreUrl)
    {
        $posts = json_decode(@file_get_contents($coreUrl . '/wp/v2/posts'), true);

        if(! $posts) {
            return false;
        }

        $this->collections->create('posts', 'Posts', '/', './content/posts');

        foreach($posts as $post) {
            $meta = [
                'title' => $post['title']['rendered'],
                'date' => $post['date']
            ];

            $content = $post['content']['rendered'];

            (new Entries())->create($post['slug'], 'posts', $meta, $content);
        }

        return true;
    }

    public function pages($coreUrl)
    {
        $pages = json_decode(@file_get_contents($coreUrl . '/wp/v2/pages'), true);

        if(! $pages) {
            return false;
        }

        $this->collections->create('pages', 'Pages', '/', './content/pages');

        foreach($pages as $page) {
            $meta = [
                'title' => $page['title']['rendered'],
                'date' => $page['date']
            ];

            $content = $page['content']['rendered'];

            $create = (new Entries())->create($page['slug'], 'pages', $meta, $content);
        }

        return true;
    }
}