<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'fais ton film') }}</title>
            <link rel="icon" type="image/png" sizes="16x16" href="https://silence-2021.s3.eu-west-3.amazonaws.com/ressources/Logos/favicon_silence_SF.png">
<link rel="icon" type="image/png" sizes="32x32" href="https://silence-2021.s3.eu-west-3.amazonaws.com/ressources/Logos/favicon_silence_SF.png">
<link rel="apple-touch-icon" sizes="180x180" href="https://silence-2021.s3.eu-west-3.amazonaws.com/ressources/Logos/favicon_silence_SF.png">


        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
