<?php

return [
	'name' => 'Systatic',
    'url' => 'http://localhost:8080',
    
	'locations' => [
		'output' => './tests/fixtures/dist',
		'views' => './tests/fixtures/views',
        'storage' => './tests/fixtures/storage'
    ],

    'collections' => [
        'pages' => [
            'name' => 'Pages',
            'permalink' => '/',
            'location' => './texts/fixtures/content'
        ]
    ],
    
	'redirects' => [
		[
			'slug' => 'google',
			'target' => 'https://google.com'
		]
	]
];