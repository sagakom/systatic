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
      'location' => './texts/fixtures/content',
    ],
    'posts' => [
      'name' => 'Posts',
      'permalink' => '/posts/',
      'location' => './content/posts',
    ],
  ],
  'redirects' => [
    0 => [
      'slug' => 'google',
      'target' => 'https://google.com',
    ],
  ],
];
