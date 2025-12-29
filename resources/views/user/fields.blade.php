<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ request('category') == 'badminton' ? 'Daftar Lapangan Badminton' : (request('category') == 'basketball' ? 'Daftar Lapangan Basket' : 'Daftar Lapangan Futsal') }}
            </h2>
            <div class="flex items-center space-x-2 text-sm text-gray-500">
                <a href="{{ url('/dashboard') }}" class="hover:text-emerald-600">Home</a>
                <span>/</span>
                <span
                    class="text-gray-900">{{ request('category') == 'badminton' ? 'Badminton' : (request('category') == 'basketball' ? 'Basket' : 'Futsal') }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Dynamic Title based on Category -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @if(request('category') == 'badminton')
                    <!-- BADMINTON COURTS -->
                    <!-- Court 1 -->
                    <div
                        class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
                        <div class="relative h-48">
                            <img src="https://images.unsplash.com/photo-1626224583764-84786c71971e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                class="w-full h-full object-cover" alt="Badminton 1">
                            <div
                                class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-emerald-600 shadow-sm">
                                Indoor
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900">Badminton Court 1</h3>
                                    <p class="text-sm text-gray-500">Karpet Standar</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-bold text-emerald-600">Rp 80.000</p>
                                    <p class="text-xs text-gray-400">/ jam</p>
                                </div>
                            </div>

                            <div class="mt-4 flex flex-wrap gap-2">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                    💡 LED Lighting
                                </span>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-50 text-orange-700">
                                    👟 Non-Slip
                                </span>
                            </div>

                            <div class="mt-6">
                                <a href="{{ url('/booking/4') }}"
                                    class="block w-full text-center bg-gray-900 hover:bg-gray-800 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                                    Lihat Jadwal & Booking
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Court 2 -->
                    <div
                        class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
                        <div class="relative h-48">
                            <img src="https://images.unsplash.com/photo-1596723220452-95f36e8b2b9f?q=80&w=2670&auto=format&fit=crop"
                                class="w-full h-full object-cover" alt="Badminton 2">
                            <div
                                class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-blue-600 shadow-sm">
                                Pro
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900">Badminton Court 2</h3>
                                    <p class="text-sm text-gray-500">Karpet Yonex Original</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-bold text-emerald-600">Rp 100.000</p>
                                    <p class="text-xs text-gray-400">/ jam</p>
                                </div>
                            </div>

                            <div class="mt-4 flex flex-wrap gap-2">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-50 text-green-700">
                                    🏸 Karpet Yonex
                                </span>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                    🌬️ Good Airflow
                                </span>
                            </div>

                            <div class="mt-6">
                                <a href="{{ url('/booking/5') }}"
                                    class="block w-full text-center bg-gray-900 hover:bg-gray-800 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                                    Lihat Jadwal & Booking
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Court 3 -->
                    <div
                        class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
                        <div class="relative h-48">
                            <img src="https://images.unsplash.com/photo-1622363989397-90ff6a27e02e?q=80&w=2671&auto=format&fit=crop"
                                class="w-full h-full object-cover" alt="Badminton 3">
                            <div
                                class="absolute top-4 right-4 bg-purple-600/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-white shadow-sm">
                                VVIP
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900">Badminton Court 3</h3>
                                    <p class="text-sm text-gray-500">VVIP Private Court</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-bold text-emerald-600">Rp 150.000</p>
                                    <p class="text-xs text-gray-400">/ jam</p>
                                </div>
                            </div>

                            <div class="mt-4 flex flex-wrap gap-2">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-50 text-purple-700">
                                    👑 Private Court
                                </span>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-cyan-50 text-cyan-700">
                                    ❄️ Full AC
                                </span>
                            </div>

                            <div class="mt-6">
                                <a href="{{ url('/booking/6') }}"
                                    class="block w-full text-center bg-gray-900 hover:bg-gray-800 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                                    Lihat Jadwal & Booking
                                </a>
                            </div>
                        </div>
                    </div>

                @elseif(request('category') == 'basketball')
                    <!-- BASKETBALL COURTS -->
                    <!-- Court 1 -->
                    <div
                        class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
                        <div class="relative h-48">
                            <img src="https://images.unsplash.com/photo-1546519638-68e109498ffc?q=80&w=2690&auto=format&fit=crop"
                                class="w-full h-full object-cover" alt="Basket 1">
                            <div
                                class="absolute top-4 right-4 bg-orange-500/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-white shadow-sm">
                                Outdoor
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900">Basketball Court 1</h3>
                                    <p class="text-sm text-gray-500">Lapangan Outdoor Plester Halus</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-bold text-emerald-600">Rp 100.000</p>
                                    <p class="text-xs text-gray-400">/ jam</p>
                                </div>
                            </div>

                            <div class="mt-4 flex flex-wrap gap-2">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-50 text-orange-700">
                                    🏀 Ring Standar
                                </span>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                    🌤️ Outdoor Area
                                </span>
                            </div>

                            <div class="mt-6">
                                <a href="{{ url('/booking/7') }}"
                                    class="block w-full text-center bg-gray-900 hover:bg-gray-800 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                                    Lihat Jadwal & Booking
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Court 2 -->
                    <div
                        class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
                        <div class="relative h-48">
                            <img src="https://images.unsplash.com/photo-1505666287802-93144f1756d3?q=80&w=2574&auto=format&fit=crop"
                                class="w-full h-full object-cover" alt="Basket 2">
                            <div
                                class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-emerald-600 shadow-sm">
                                Indoor
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900">Basketball Court 2</h3>
                                    <p class="text-sm text-gray-500">Lantai Vinyl Sport</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-bold text-emerald-600">Rp 150.000</p>
                                    <p class="text-xs text-gray-400">/ jam</p>
                                </div>
                            </div>

                            <div class="mt-4 flex flex-wrap gap-2">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                    🏟️ Full Indoor
                                </span>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-50 text-green-700">
                                    🦶 Anti-Cedera
                                </span>
                            </div>

                            <div class="mt-6">
                                <a href="{{ url('/booking/8') }}"
                                    class="block w-full text-center bg-gray-900 hover:bg-gray-800 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                                    Lihat Jadwal & Booking
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Court 3 -->
                    <div
                        class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
                        <div class="relative h-48">
                            <img src="https://images.unsplash.com/photo-1504450758481-7338eba7524a?q=80&w=2669&auto=format&fit=crop"
                                class="w-full h-full object-cover" alt="Basket 3">
                            <div
                                class="absolute top-4 right-4 bg-purple-600/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-white shadow-sm">
                                PRO NBA
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900">Basketball Court 3</h3>
                                    <p class="text-sm text-gray-500">Parquet Kayu FIBA Standard</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-bold text-emerald-600">Rp 250.000</p>
                                    <p class="text-xs text-gray-400">/ jam</p>
                                </div>
                            </div>

                            <div class="mt-4 flex flex-wrap gap-2">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-50 text-purple-700">
                                    🏆 FIBA Approved
                                </span>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-50 text-orange-700">
                                    🏀 Pro Rings
                                </span>
                            </div>

                            <div class="mt-6">
                                <a href="{{ url('/booking/9') }}"
                                    class="block w-full text-center bg-gray-900 hover:bg-gray-800 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                                    Lihat Jadwal & Booking
                                </a>
                            </div>
                        </div>
                    </div>

                @else
                    <!-- FUTSAL COURTS (Default) -->
                    <!-- Field Card 1 -->
                    <div
                        class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
                        <div class="relative h-48">
                            <img src="https://i.pinimg.com/1200x/47/a1/35/47a135ace3bb63af9268b3dc450b5008.jpg"
                                class="w-full h-full object-cover" alt="Lapangan 1">
                            <div
                                class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-emerald-600 shadow-sm">
                                Indoor
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900">Lapangan Futsal 1</h3>
                                    <p class="text-sm text-gray-500">Lantai Vinyl Premium</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-bold text-emerald-600">Rp 120.000</p>
                                    <p class="text-xs text-gray-400">/ jam</p>
                                </div>
                            </div>

                            <div class="mt-4 flex flex-wrap gap-2">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                    ⚡ Scoreboard
                                </span>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                    🅿️ Parkir Luas
                                </span>
                            </div>

                            <div class="mt-6">
                                <a href="{{ url('/booking/1') }}"
                                    class="block w-full text-center bg-gray-900 hover:bg-gray-800 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                                    Lihat Jadwal & Booking
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Field Card 2 -->
                    <div
                        class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
                        <div class="relative h-48">
                            <img src="https://images.unsplash.com/photo-1529900748604-07564a03e7a6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                class="w-full h-full object-cover" alt="Lapangan 2">
                            <div
                                class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-blue-600 shadow-sm">
                                Semi-Outdoor
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900">Lapangan Futsal 2</h3>
                                    <p class="text-sm text-gray-500">Rumput Sintetis Standard FIFA</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-bold text-emerald-600">Rp 150.000</p>
                                    <p class="text-xs text-gray-400">/ jam</p>
                                </div>
                            </div>

                            <div class="mt-4 flex flex-wrap gap-2">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700">
                                    🌱 Rumput Sintetis
                                </span>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                    🚿 Shower Room
                                </span>
                            </div>

                            <div class="mt-6">
                                <a href="{{ url('/booking/2') }}"
                                    class="block w-full text-center bg-gray-900 hover:bg-gray-800 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                                    Lihat Jadwal & Booking
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Field Card 3 -->
                    <div
                        class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
                        <div class="relative h-48">
                            <img src="https://images.unsplash.com/photo-1552667466-07770ae110d0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                class="w-full h-full object-cover" alt="Lapangan 3">
                            <div
                                class="absolute top-4 right-4 bg-indigo-600/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-white shadow-sm">
                                VVIP
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900">Lapangan Futsal 3</h3>
                                    <p class="text-sm text-gray-500">Lantai Interlock Professional</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-bold text-emerald-600">Rp 200.000</p>
                                    <p class="text-xs text-gray-400">/ jam</p>
                                </div>
                            </div>

                            <div class="mt-4 flex flex-wrap gap-2">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700">
                                    🏆 Standar Kompetisi
                                </span>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-cyan-50 text-cyan-700">
                                    ❄️ Full AC
                                </span>
                            </div>

                            <div class="mt-6">
                                <a href="{{ url('/booking/3') }}"
                                    class="block w-full text-center bg-gray-900 hover:bg-gray-800 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                                    Lihat Jadwal & Booking
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>