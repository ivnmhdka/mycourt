<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Jadwal Lapangan') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="scheduleManager()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <!-- Filters -->
                    <div class="flex flex-col md:flex-row gap-4 mb-8 items-end">
                        <div class="w-full md:w-1/3">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Lapangan</label>
                            <select class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                <option>Futsal 1 (Vinyl)</option>
                                <option>Futsal 2 (Sintetis)</option>
                                <option>Badminton A</option>
                            </select>
                        </div>
                        <div class="w-full md:w-1/3">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                            <input type="date" value="{{ date('Y-m-d') }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        </div>
                        <div class="w-full md:w-auto pb-1">
                            <button class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition">Load Jadwal</button>
                        </div>
                    </div>

                    <!-- Legend -->
                    <div class="flex items-center space-x-6 mb-6 p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center text-sm">
                            <span class="w-4 h-4 rounded bg-emerald-100 border border-emerald-500 mr-2"></span>
                            Tersedia (Bisa Dibooking)
                        </div>
                        <div class="flex items-center text-sm">
                            <span class="w-4 h-4 rounded bg-red-100 border border-red-500 mr-2"></span>
                            Terisi (User Booking)
                        </div>
                         <div class="flex items-center text-sm">
                            <span class="w-4 h-4 rounded bg-gray-600 border border-gray-800 mr-2"></span>
                            Blocked (Maintenance/Offline)
                        </div>
                    </div>

                    <!-- Grid -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-4">
                        @foreach(['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00'] as $time)
                            @php
                                // Mock initial states
                                $isBooked = in_array($time, ['19:00', '20:00']);
                                $isBlocked = in_array($time, ['13:00']); 
                            @endphp
                            
                            <div 
                                class="relative border rounded-xl p-4 flex flex-col items-center justify-between h-32 transition-colors"
                                :class="{
                                    'bg-red-50 border-red-200': '{{ $isBooked }}' == '1',
                                    'bg-gray-200 border-gray-400': blockedSlots.includes('{{ $time }}') || '{{ $isBlocked }}' == '1',
                                    'bg-emerald-50 border-emerald-200': !('{{ $isBooked }}' == '1') && !blockedSlots.includes('{{ $time }}') && !('{{ $isBlocked }}' == '1')
                                }"
                            >
                                <span class="font-bold text-lg text-gray-700">{{ $time }}</span>
                                
                                <!-- Status Badge -->
                                <div class="mt-2">
                                    @if($isBooked)
                                        <span class="text-xs font-bold text-red-600 uppercase">Booked</span>
                                        <p class="text-[10px] text-gray-500">Budi S.</p>
                                    @elseif($isBlocked)
                                        <span class="text-xs font-bold text-gray-700 uppercase">Blocked</span>
                                    @else
                                        <span x-show="blockedSlots.includes('{{ $time }}')" class="text-xs font-bold text-gray-700 uppercase">Blocked</span>
                                        <span x-show="!blockedSlots.includes('{{ $time }}')" class="text-xs font-bold text-emerald-600 uppercase">Open</span>
                                    @endif
                                </div>

                                <!-- Action Toggle -->
                                @if(!$isBooked)
                                <div class="absolute top-2 right-2">
                                    <button @click="toggleBlock('{{ $time }}')" class="text-gray-400 hover:text-gray-600 focus:outline-none" title="Toggle Block/Unblock">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 6.524a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8 flex justify-end">
                        <button class="bg-emerald-600 text-white px-6 py-2 rounded-lg font-bold shadow-lg hover:bg-emerald-700 transition">
                            Simpan Perubahan Jadwal
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function scheduleManager() {
            return {
                blockedSlots: [],
                toggleBlock(time) {
                    if (this.blockedSlots.includes(time)) {
                        this.blockedSlots = this.blockedSlots.filter(t => t !== time);
                    } else {
                        this.blockedSlots.push(time);
                    }
                }
            }
        }
    </script>
</x-app-layout>
