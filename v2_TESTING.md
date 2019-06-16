# v2 Testing

If you want to test out Systatic v2 while it's still in development, then you can follow these install instructions.

You'll need to have Composer and PHP installed on your machine.

**Please don't test v2 in a production application, as it's not stable and tests still need to be written.**

1. Create a new directory and CD into that directory

```
mkdir test
cd test
```

2. Install Systatic in that directory

```
composer require damcclean/systatic:v2.x-dev
```

3. Create base folders

```
php vendor/damcclean/systatic/init init
```

4. Replace the contents of `views/index.blade.php` with this:

```
<!doctype html>
<html lang="en">
	<head>
		<title>Systatic</title>
		<meta charset="UTF-8">
	  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	  	<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
		<style>
			h1 {
				font-size: 40px;
			}
			h2 {
				font-size: 30px;
			}
			p {
				padding: 5px;
				font-size: 17px;
			}
			ul {
				list-style: disc;
				margin-right: 20px;
			}
		</style>
	</head>
	<body class="text-black bg-white text-gray-800 font-normal leading-loose">
	  <header class="w-full bg-gray-200 p-2 px-6 flex flex-col md:flex-row justify-center items-center mb-12">
		  	@foreach($collections->sortBy('title') as $thing)
		  		<a class="mx-2" href="/{{ $thing['slug'] }}.html">
		  			{{ $thing['title'] }}
		  		</a>
		  	@endforeach
	  </header>
	  <main class="container mx-auto mb-12">
	  	<div class="md:w-2/3 md:mx-auto">
	  		<h1 class="mb-6">{{ $title }}</h1>
            {!! $content !!}
	  	</div>
	  </main>
	</body>
</html>
```

5. Build your site

```
php systatic build
```

If you have feedback on v2, please let us know either by opening up an issue or by joining our Discord community.