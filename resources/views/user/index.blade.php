<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pilih Cabang Olahraga') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Futsal Card -->
                <a href="{{ url('/fields?category=futsal') }}" class="group block overflow-hidden rounded-2xl bg-white shadow-lg transition-all hover:-translate-y-1 hover:shadow-2xl">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=2693&auto=format&fit=crop" 
                             alt="Futsal" 
                             class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                        <div class="absolute bottom-0 p-6">
                            <h3 class="text-3xl font-bold text-white">Futsal</h3>
                            <p class="mt-2 text-sm text-gray-200">Lapangan Vinyl & Sintetis standar FIFA.</p>
                        </div>
                    </div>
                </a>

                <!-- Badminton Card -->
                <a href="{{ url('/fields?category=badminton') }}" class="group block overflow-hidden rounded-2xl bg-white shadow-lg transition-all hover:-translate-y-1 hover:shadow-2xl">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://i.pinimg.com/736x/2e/8b/3d/2e8b3d634b9cd14891bfbb00d0c4e7b5.jpg" 
                             alt="Badminton" 
                             class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                        <div class="absolute bottom-0 p-6">
                            <h3 class="text-3xl font-bold text-white">Badminton</h3>
                            <p class="mt-2 text-sm text-gray-200">Karpet karet kualitas pro & pencahayaan terang.</p>
                        </div>
                    </div>
                </a>

                <!-- Basketball Card -->
                <a href="{{ url('/fields?category=basketball') }}" class="group block overflow-hidden rounded-2xl bg-white shadow-lg transition-all hover:-translate-y-1 hover:shadow-2xl">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1546519638-68e109498ffc?q=80&w=2690&auto=format&fit=crop" 
                             alt="Basket" 
                             class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                        <div class="absolute bottom-0 p-6">
                            <h3 class="text-3xl font-bold text-white">Basket</h3>
                            <p class="mt-2 text-sm text-gray-200">Lapangan indoor & outdoor full court.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
