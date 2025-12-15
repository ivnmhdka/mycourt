<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MyCourt') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900 bg-gray-50">
        <div class="min-h-screen flex flex-col">
            @include('partials.navbar')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="flex-grow">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-gray-800 text-white py-10 mt-auto">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="col-span-1 md:col-span-2">
                        <h2 class="text-2xl font-bold text-emerald-500 mb-4">MyCourt</h2>
                        <p class="text-gray-400 max-w-sm">
                            Platform booking lapangan olahraga #1 dengan sistem real-time terpercaya. Main kapan saja, booking di mana saja.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Layanan</h3>
                        <ul class="space-y-2 text-gray-400">
                            <li><a href="#" class="hover:text-emerald-500">Daftar Lapangan</a></li>
                            <li><a href="#" class="hover:text-emerald-500">Cara Booking</a></li>
                            <li><a href="#" class="hover:text-emerald-500">Informasi Tarif</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Bantuan</h3>
                        <ul class="space-y-2 text-gray-400">
                            <li><a href="#" class="hover:text-emerald-500">FAQ</a></li>
                            <li><a href="#" class="hover:text-emerald-500">Hubungi Kami</a></li>
                            <li><a href="#" class="hover:text-emerald-500">Syarat & Ketentuan</a></li>
                        </ul>
                    </div>
                </div>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 pt-8 border-t border-gray-700 text-center text-gray-500">
                    &copy; {{ date('Y') }} MyCourt Official. All rights reserved.
                </div>
            </footer>
        </div>
    </body>
</html>
