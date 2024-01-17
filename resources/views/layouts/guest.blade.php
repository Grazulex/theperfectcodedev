<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/ico/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/ico/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/ico/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('images/ico/manifest.json') }}">
    <link rel="mask-icon" href="{{ asset('images/ico/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
    <body class="antialiased text-gray-900" x-data="themeSwitcher()" :class="{ 'dark': switchOn }">
    <div>
        <div class="xl:grid xl:grid-cols-2 xl:space-y-0 dark:bg-[#0F1828]">
            <div class="bg-right-bottom bg-cover bg-no-repeat relative group bg-[url('/resources/images/imagelogin.jpg')]">
            </div>

            <div class="flex justify-center">
                <div class="overflow-hiddenshadow-md sm:max-w-md sm:rounded-lg">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
    </body>
</html>
