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

            <!-- Dynamic Fields Grid -->
            <!-- Note: Controller passes $fields filtered by category already -->
            @forelse($fields as $field)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
                    <div class="relative h-48">
                        <img src="{{ $field->image_path }}" class="w-full h-full object-cover" alt="{{ $field->name }}">
                        <!-- Optional Badge logic based on description or price? Keeping it simple for now -->
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-emerald-600 shadow-sm">
                            {{ $field->category }}
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">{{ $field->name }}</h3>
                                <p class="text-sm text-gray-500">{{ Str::limit($field->description, 40) }}</p>
                            </div>
                            <div class="text-right flex-shrink-0">
                                <p class="text-lg font-bold text-emerald-600 whitespace-nowrap">Rp {{ number_format($field->price_per_hour, 0, ',', '.') }}</p>
                                <p class="text-xs text-gray-400">/ jam</p>
                            </div>
                        </div>

                        <!-- Features (Static for now, or extracted from description) -->
                        <div class="mt-4 flex flex-wrap gap-2">
                             <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                ⭐ {{ $field->category }} Court
                             </span>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('booking.show', $field->id) }}"
                                class="block w-full text-center bg-gray-900 hover:bg-gray-800 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                                Lihat Jadwal & Booking
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12 text-gray-500">
                    Belum ada lapangan tersedia untuk kategori ini.
                </div>
            @endforelse

            </div>
        </div>
    </div>
</x-app-layout>