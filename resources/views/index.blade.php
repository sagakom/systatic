<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/app.css">
    <title>@siteName()</title>
</head>
<body>
    <div id="app">
        <header class="bg-black p-2">
            <div class="container mx-auto">
                <a class="no-underline" href="@siteUrl()">
                    <h2 class="font-2xl text-center text-white">
                        @siteName()
                    </h2>
                </a>
            </div>
        </header>
    
        <div class="container mx-auto">
            <div class="content p-6 leading-normal tracking-normal">
                @content()
            </div>
        </div>
    
        <div class="footer bg-grey-lighter p-4 mt-6">
            <div class="container mx-auto">
                <p class="text-sm text-center mb-2 mt-2">Powered by Thunderbird.</p>
            </div>
        </div>
    </div>

    <script src="/js/app.js"></script>
</body>
</html>