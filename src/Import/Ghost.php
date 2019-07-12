<?php

namespace Damcclean\Systatic\Import;

use Damcclean\Systatic\Collections\Collections;
use Damcclean\Systatic\Collections\Entries;
use Damcclean\Systatic\Config\Config;

class Ghost
{
    public function __construct()
    {
        $this->config = new Config();
        $this->collections = new Collections();
    }

    public function import($apiKey, $siteUrl)
    {
        $settings = $this->settings($apiKey, $siteUrl);
        $posts = $this->posts($apiKey, $siteUrl);
        $pages = $this->pages($apiKey, $siteUrl);

        return true;
    }

    public function settings($apiKey, $siteUrl)
    {
        $settings = json_decode(@file_get_contents($siteUrl . '/ghost/api/v2/content/settings?key=' . $apiKey), true);

        if(! $settings) {
            return false;
        }

        $config = $settings['settings'];

        foreach($config as $key => $value)  {
            if($key == "title") {
                $config['name'] = $config['title'];
                unset($config['title']);
            }

            if(strpos($key, 'ghost') != false) {
                unset($config["{$key}"]);
            }

            if($value == null) {
                unset($config["{$key}"]);
            }
        }

        $this->config->updateArray($config);

        return true;
    }

    public function posts($apiKey, $siteUrl)
    {
        $posts = json_decode(@file_get_contents($siteUrl . '/ghost/api/v2/content/posts?key=' . $apiKey), true);

        if(! $posts) {
            return false;
        }

        $this->collections->create('posts', 'Posts', '/', './content/posts');

        foreach($posts['posts'] as $post) {
            $meta = [
                'title' => $post['title'],
                'date' => $post['published_at']
            ];

            if($post['meta_title'] != null) {
                $meta['meta_title'] = $post['meta_title'];
            }

            if($post['meta_description'] != null) {
                $meta['meta_description'] = $post['meta_description'];
            }

            $content = $post['html'];

            (new Entries())->create($post['slug'], 'posts', $meta, $content);
        }

        return true;
    }

    public function pages($apiKey, $siteUrl)
    {
        $pages = json_decode(@file_get_contents($siteUrl . '/ghost/api/v2/content/pages?key=' . $apiKey), true);

        if(! $pages) {
            return false;
        }

        $this->collections->create('pages', 'Pages', '/', './content/pages');

        foreach($pages['pages'] as $page) {
            $meta = [
                'title' => $page['title'],
                'date' => $page['published_at']
            ];

            if($page['meta_title'] != null) {
                $meta['meta_title'] = $page['meta_title'];
            }

            if($page['meta_description'] != null) {
                $meta['meta_description'] = $page['meta_description'];
            }

            $content = $page['html'];

            (new Entries())->create($page['slug'], 'pages', $meta, $content);
        }

        return true;
    }
}