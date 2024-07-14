<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>
        @routes
        @vite(['resources/js/app.js'])
        @inertiaHead
        <script defer data-domain="wetter.marcelwagner.dev" src="https://plausible.marcelwagner.dev/js/script.js"></script>
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
