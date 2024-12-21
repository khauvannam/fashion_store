<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <link rel="stylesheet" href="{{asset('assets/vendor/ckeditor5.css')}}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans ">
<div class="min-h-screen ">
    <div class="antialiased bg-gray-50 dark:bg-gray-900" x-data="{ open: true }">
        <nav
            class="bg-white border-b border-gray-200 px-4 py-2.5 dark:bg-gray-800 dark:border-gray-700 fixed left-0 right-0 top-0 z-50">
            <livewire:layout.nav-admin/>
        </nav>
        <livewire:layout.aside-admin/>
        <main class="p-4 md:ml-64 h-auto pt-20">
            {{ $slot }}
        </main>
    </div>
</div>

@stack('scripts')

</body>
</html>
