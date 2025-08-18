<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ asset('img/icon.jpeg') }}" type="image/x-icon">
        <title>{{ config('app.name', 'Toucan Creative') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <!-- Scripts -->
        
        <style>
            .transparent-dropdown [role="menu"] {
                background-color: rgba(31, 41, 55, 0.8) !important;
                backdrop-filter: blur(8px);
            }
            
            /* For dark theme */
            .transparent-dropdown [role="menu"] {
                background-color: rgba(255, 255, 255, 0.8) !important;
                backdrop-filter: blur(8px);
            }
        </style>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-[#2D3A43]"> 
            @include('layouts.navigation')

            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
