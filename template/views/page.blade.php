<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
    <title>Site name</title>
</head>
<body>
    
    <header class="bg-black p-2">
        <div class="container mx-auto">
            <a class="no-underline" href="/">
                <h2 class="font-2xl text-center text-white">
                    Site name
                </h2>
            </a>
        </div>
    </header>

    <div class="container mx-auto">
        @content
    </div>

    <div class="footer bg-grey-lighter p-4 mt-6">
        <div class="container mx-auto">
            <p class="text-sm text-center mb-2 mt-2">Powered by Thunderbird</p>
        </div>
    </div>

</body>
</html>