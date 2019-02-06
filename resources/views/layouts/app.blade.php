<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/app.css">
    <title>{{ $title }} - @siteName()</title>
</head>
<body class="text-base leading-loose text-black font-sans bg-white">
    <div id="app">
        @include('partials.header')
    
        @yield('content')
    
        @include('partials.footer')
    </div>

    <script src="/js/app.js"></script>
</body>
</html>