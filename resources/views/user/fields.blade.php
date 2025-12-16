<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Lapangan Futsal') }}
            </h2>
            <div class="flex items-center space-x-2 text-sm text-gray-500">
                <a href="{{ url('/dashboard') }}" class="hover:text-emerald-600">Home</a>
                <span>/</span>
                <span class="text-gray-900">Futsal</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Field Card 1 -->
                @for ($i = 1; $i <= 3; $i++)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
                    <div class="relative h-48">
                        <img src="https://images.unsplash.com/photo-1518605348435-e000c0179c75?q=80&w=2670&auto=format&fit=crop" class="w-full h-full object-cover" alt="Lapangan A">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-emerald-600 shadow-sm">
                            Indoor
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Lapangan Futsal {{ $i }}</h3>
                                <p class="text-sm text-gray-500">Lantai Vinyl Premium</p>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-bold text-emerald-600">Rp 120.000</p>
                                <p class="text-xs text-gray-400">/ jam</p>
                            </div>
                        </div>
                        
                        <div class="mt-4 flex flex-wrap gap-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                ⚡ Scoreboard
                            </span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                🅿️ Parkir Luas
                            </span>
                        </div>

                        <div class="mt-6">
                            <a href="{{ url('/booking/1') }}" class="block w-full text-center bg-gray-900 hover:bg-gray-800 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                                Lihat Jadwal & Booking
                            </a>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>
</x-app-layout>
