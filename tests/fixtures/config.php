<?php
return [
	'name' => 'Systatic',
	'env' => env('APP_ENV'),
    'url' => 'http://localhost:8080',
    
	'locations' => [
		'output' => './tests/fixtures/dist',
		'views' => './tests/fixtures/views',
        'storage' => './tests/fixtures/storage'
    ],

    'collections' => [
        'normal' => [
            'name' => 'Normal Content',
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