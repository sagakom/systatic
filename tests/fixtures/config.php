<?php

return [
	'name' => 'Systatic',
	'env' => env('APP_ENV'),
	'url' => 'http://localhost:8080',

	'locations' => [
		'output' => './tests/fixtures/dist',
		'content' => './tests/fixtures/content',
		'views' => './tests/fixtures/views',
		'storage' => './tests/fixtures/storage'
	]
];