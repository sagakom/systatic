# Breaking changes

* New Systatic console file
* Removed `@env` blade directive
* Instead of `matter` in templates, it is now `meta`
* New `collections.json` file in the `storage` directory.
* Stubs have changed location
* Configuration changed completly
* Removed the content location option from the locations config array
* You are now required to configure content collections
* Redirects looks like this now:

```
[
	'slug' => 'bing',
	'target' => 'https://bing.com'
]
```

When installing for the first time, user can run this command

```
php vendor/damcclean/systatic/init init
```

* If you want to enable Algolia search you can fill out these fields in your `config.php` file

```
'algolia' => [
		'app_id' => '',
		'api_key' => '',
		'index' => ''
],
```