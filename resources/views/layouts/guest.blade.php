<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MyCourt') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-white">
    
    <div class="flex min-h-screen w-full">
        
        <div class="hidden lg:flex lg:w-1/2 relative bg-emerald-900 items-center justify-center overflow-hidden">
            
            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1574629810360-7efdd9604977?q=80&w=1471&auto=format&fit=crop" 
                     alt="Sports Court Background" 
                     class="w-full h-full object-cover opacity-30 mix-blend-luminosity">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-emerald-900 via-emerald-900/80 to-emerald-800/50 z-5"></div>

            <div class="relative z-10 p-12 text-white">
                <h2 class="text-5xl font-bold mb-6 tracking-tight leading-tight">Booking Lapangan,<br> Langsung Main.</h2>
                <p class="text-lg text-emerald-100 max-w-md leading-relaxed">
                    Cari jadwal kosong untuk Futsal, Basket, atau Badminton jadi lebih mudah. Temukan venue terbaik di sekitarmu.
                </p>
            </div>
            
            <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-emerald-600 rounded-full blur-3xl opacity-30 z-0"></div>
            <div class="absolute top-1/4 right-12 w-32 h-32 bg-teal-500 rounded-full blur-2xl opacity-20 z-0"></div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md">
                {{ $slot }}
            </div>
        </div>

    </div>
</body>
</html>