<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Lapangan & Booking') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="bookingSystem()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column: Field Detail & Schedule -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Field Details -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="h-64 md:h-80 relative">
                             <img src="https://images.unsplash.com/photo-1518605348435-e000c0179c75?q=80&w=2670&auto=format&fit=crop" class="w-full h-full object-cover" alt="Lapangan Detail">
                        </div>
                        <div class="p-6 md:p-8">
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">Lapangan Futsal 1 (Vinyl)</h1>
                            <div class="flex items-center text-gray-500 mb-6 text-sm">
                                <svg class="w-5 h-5 mr-2 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Jl. Olahraga No. 123, Jakarta Selatan
                            </div>
                            
                            <h3 class="font-semibold text-lg text-gray-800 mb-3">Fasilitas</h3>
                            <ul class="grid grid-cols-2 gap-4 text-gray-600 mb-6">
                                <li class="flex items-center space-x-2">
                                    <span class="text-emerald-500">✓</span> <span>Standar FIFA (25m x 15m)</span>
                                </li>
                                <li class="flex items-center space-x-2">
                                    <span class="text-emerald-500">✓</span> <span>Lantai Vinyl Polypropylene</span>
                                </li>
                                <li class="flex items-center space-x-2">
                                    <span class="text-emerald-500">✓</span> <span>Papan Skor Digital</span>
                                </li>
                                <li class="flex items-center space-x-2">
                                    <span class="text-emerald-500">✓</span> <span>Gratis Air Mineral (1 Galon)</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Schedule Grid -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Jadwal Ketersediaan</h3>
                            <div class="flex space-x-4 mt-4 md:mt-0 text-sm">
                                <div class="flex items-center"><span class="w-3 h-3 rounded-full bg-emerald-100 border border-emerald-500 mr-2"></span> Kosong</div>
                                <div class="flex items-center"><span class="w-3 h-3 rounded-full bg-red-100 border border-red-500 mr-2"></span> Terisi</div>
                                <div class="flex items-center"><span class="w-3 h-3 rounded-full bg-yellow-100 border border-yellow-500 mr-2"></span> Dipilih</div>
                            </div>
                        </div>

                        <!-- Date Picker Mockup -->
                         <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Booking</label>
                            <input type="date" value="{{ date('Y-m-d') }}" class="block w-full md:w-1/3 rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        </div>

                        <!-- Slots -->
                        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-3">
                            <!-- Mock Slots Loop -->
                            @foreach(['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00'] as $time)
                                @php
                                    $status = in_array($time, ['19:00', '20:00']) ? 'booked' : 'available';
                                @endphp
                                <button 
                                    @click="toggleSlot('{{ $time }}', '{{ $status }}')"
                                    :class="{
                                        'bg-emerald-50 border-emerald-200 text-emerald-700 hover:bg-emerald-100': '{{ $status }}' === 'available' && !selectedSlots.includes('{{ $time }}'),
                                        'bg-red-50 border-red-200 text-red-400 cursor-not-allowed': '{{ $status }}' === 'booked',
                                        'bg-yellow-50 border-yellow-400 text-yellow-700 ring-2 ring-yellow-400': selectedSlots.includes('{{ $time }}')
                                    }"
                                    class="py-3 text-sm font-medium rounded-lg border transition-all duration-200 flex flex-col items-center justify-center">
                                    <span>{{ $time }}</span>
                                    <span class="text-[10px] mt-1 font-normal" x-text="'{{ $status }}' === 'booked' ? 'Booked' : (selectedSlots.includes('{{ $time }}') ? 'Dipilih' : 'Rp 120k')"></span>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Right Column: Booking Form -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 sticky top-24">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Ringkasan Booking</h3>
                        
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Lapangan</span>
                                <span class="font-medium text-gray-900">Futsal 1 (Vinyl)</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Tanggal</span>
                                <span class="font-medium text-gray-900">{{ date('d M Y') }}</span>
                            </div>
                            <div class="border-t border-gray-100 pt-3">
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="text-gray-500">Total Durasi</span>
                                    <span class="font-medium text-gray-900"><span x-text="selectedSlots.length">0</span> Jam</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-base font-bold text-gray-900">Total Harga</span>
                                    <span class="text-xl font-bold text-emerald-600">Rp <span x-text="(selectedSlots.length * 120000).toLocaleString('id-ID')">0</span></span>
                                </div>
                            </div>
                        </div>

                        <!-- Form Action -->
                        <form action="#" method="POST">
                            @csrf
                            <input type="hidden" name="slots" :value="JSON.stringify(selectedSlots)">
                            
                            <button 
                                type="button" 
                                :disabled="selectedSlots.length === 0"
                                :class="{'opacity-50 cursor-not-allowed': selectedSlots.length === 0}"
                                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-emerald-200 transform transition hover:-translate-y-0.5"
                            >
                                Lanjut Pembayaran
                            </button>
                            <p class="text-xs text-center text-gray-400 mt-3">
                                Pastikan jadwal yang dipilih sudah sesuai.
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Simple Alpine.js Logic -->
    <script>
        function bookingSystem() {
            return {
                selectedSlots: [],
                toggleSlot(time, status) {
                    if (status === 'booked') return;
                    
                    if (this.selectedSlots.includes(time)) {
                        this.selectedSlots = this.selectedSlots.filter(t => t !== time);
                    } else {
                        this.selectedSlots.push(time);
                    }
                    this.selectedSlots.sort();
                }
            }
        }
    </script>
</x-app-layout>
