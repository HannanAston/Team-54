<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <title>@yield('title', config('app.name'))</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-[#f0f0f0] text-[#333]">

    <div class="min-h-screen flex items-center justify-center px-4">

        <!-- CENTERED WRAPPER -->
        <div class="w-full max-w-md mx-auto">

            <!-- LOGO -->
            <div class="flex justify-center mb-10">
                <a href="/" class="transition hover:opacity-80">
                    <x-mainLogo class="w-64 h-auto" />
                </a>
            </div>

            <!-- PAGE CONTENT -->
            {{ $slot }}

        </div>

    </div>

</body>

</html>
