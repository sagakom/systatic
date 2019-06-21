<?php

return [
	'name' => 'Systatic',
	'env' => 'local',
	'url' => 'http://localhost:8080',

	'locations' => [
		'output' => './dist',
		'views' => './views',
		'storage' => './storage',
		'plugins' => './plugins'
	],

	'collections' => [
		'pages' => [
			'name' => 'Pages',
            'permalink' => '/',
            'location' => './content/pages'
		]
	]
];