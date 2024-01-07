<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        @vite(['resources/css/app.css', 'resources/sass/main.sass', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <h1>Cut Shop</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id, placeat, sint. Autem eveniet ex laboriosam modi
            officia quia tempore. Deleniti dolores dolorum error excepturi nam non quidem reprehenderit sint, ut?</p>

            
        @php phpinfo() @endphp
    </body>
</html>
