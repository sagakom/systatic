<?php

namespace Damcclean\Systatic\Collections;

use Damcclean\Systatic\Config\Config;
use Algolia\AlgoliaSearch\SearchClient;

class Search
{
    public function __construct()
    {
        $this->config = new Config();
        $this->collections = new Collections();
    }

    public function index($items)
    {
        if ($this->config->get('algolia.app_id') != null && $this->config->get('algolia.api_key') != null) {
            $client = SearchClient::create(
                $this->config->get('algolia.app_id'),
                $this->config->get('algolia.api_key')
            );

            $index = $client->initIndex($this->config->get('algolia.index'));

            $index->saveObjects($items, [
                'objectIDKey' => 'slug',
            ]);

            return true;
        }

        return false;
    }
}
