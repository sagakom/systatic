<?php

return [
    'name' => 'Systatic',
    'url' => 'http://localhost:8080',

    'locations' => [
        'output' => './dist',
        'views' => './views',
        'storage' => './storage'
    ],

    'collections' => [
        'pages' => [
            'name' => 'Pages',
            'permalink' => '/',
            'location' => './content/pages'
        ]
    ]
];