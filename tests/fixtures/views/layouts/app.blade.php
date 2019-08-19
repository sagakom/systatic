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
	  		<a class="mx-4 font-bold" href="/">
	  			{{ $name }}
		  	</a>
		  	@foreach($pages as $page)
		  		<a class="mx-2" href="{{ $page->permalink }}">
		  			{{ $page->title }}
		  		</a>
		  	@endforeach
	  </header>
	  <main class="container mx-auto mb-12">
	  	<div class="md:w-2/3 md:mx-auto">
	  		@yield('content')
	  	</div>
	  </main>
	</body>
</html>