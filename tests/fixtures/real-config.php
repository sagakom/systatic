<?php

return [
    'name' => 'Systatic',
    'url' => 'http://localhost:8080',

    'locations' => [
        'output' => './tests/fixtures/dist',
        'views' => './tests/fixtures/views',
        'storage' => './tests/fixtures/storage',
    ],

    'collections' => [
        'pages' => [
            'name' => 'Pages',
            'permalink' => '/',
            'location' => './tests/fixtures/content/pages',
        ],

        'posts' => [
            'name' => 'Posts',
            'permalink' => '/posts/',
            'location' => './tests/fixtures/content/posts',
        ],

        'favourites' => [
            'name' => 'Favourites',
            'permalink' => '/favourites/',
            'remote' => function () {
                $news = json_decode(file_get_contents('./tests/fixtures/fake-remote-api.json'), true);

                return collect($news)->map(function ($item) {
                    return [
                        'title' => $item['title'],
                        'slug' => $item['slug'],
                        'content' => $item['content'],
                    ];
                });
            },
        ],
    ],

    'redirects' => [
        [
            'slug' => 'google',
            'target' => 'https://google.com',
        ],
    ],
];
