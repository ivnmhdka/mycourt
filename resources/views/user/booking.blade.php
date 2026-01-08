<x-app-layout>
    @php
        $fieldsConfig = [
            1 => [
                'name' => 'Lapangan Futsal 1',
                'type' => 'Lantai Vinyl Premium',
                'price' => 120000,
                'image' => 'https://i.pinimg.com/1200x/47/a1/35/47a135ace3bb63af9268b3dc450b5008.jpg',
                'description' => 'Lapangan indoor dengan lantai vinyl premium yang nyaman dan aman untuk permainan cepat.',
                'facilities' => ['Standar FIFA (25m x 15m)', 'Lantai Vinyl Premium', 'Scoreboard Digital', 'Gratis Air Mineral']
            ],
            2 => [
                'name' => 'Lapangan Futsal 2',
                'type' => 'Rumput Sintetis Standard FIFA',
                'price' => 150000,
                'image' => 'https://images.unsplash.com/photo-1529900748604-07564a03e7a6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'description' => 'Rasakan sensasi bermain di rumput sintetis berkualitas tinggi dengan sirkulasi udara semi-outdoor.',
                'facilities' => ['Rumput Sintetis FIFA', 'Semi-Outdoor (Sirkulasi Udara Bagus)', 'Shower Room Available', 'Lampu LED Terang']
            ],
            3 => [
                'name' => 'Lapangan Futsal 3 (VVIP)',
                'type' => 'Lantai Interlock Professional',
                'price' => 200000,
                'image' => 'https://images.unsplash.com/photo-1552667466-07770ae110d0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'description' => 'Lapangan VVIP dengan fasilitas premium, Full AC, dan lantai interlock standar kompetisi.',
                'facilities' => ['Lantai Interlock Professional', 'Full AC (Air Conditioner)', 'Ruang Ganti Private', 'Standar Kompetisi Internasional']
            ],
            // BADMINTON COURTS
            4 => [
                'name' => 'Badminton Court 1',
                'type' => 'Karpet Standar',
                'price' => 80000,
                'image' => 'https://images.unsplash.com/photo-1626224583764-84786c71971e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'description' => 'Lapangan badminton standar dengan penerangan LED yang optimal.',
                'facilities' => ['Karpet Standar', 'LED Lighting', 'Non-Slip Floor', 'Net Standar PBSI']
            ],
            5 => [
                'name' => 'Badminton Court 2',
                'type' => 'Karpet Yonex Original',
                'price' => 100000,
                'image' => 'https://images.unsplash.com/photo-1596723220452-95f36e8b2b9f?q=80&w=2670&auto=format&fit=crop',
                'description' => 'Lapangan pro dengan karpet Yonex original untuk kenyamanan maksimal.',
                'facilities' => ['Karpet Yonex Original', 'Good Airflow', 'Professional Net', 'Scoreboard Manual']
            ],
            6 => [
                'name' => 'Badminton Court 3 (VVIP)',
                'type' => 'VVIP Private Court',
                'price' => 150000,
                'image' => 'https://images.unsplash.com/photo-1622363989397-90ff6a27e02e?q=80&w=2671&auto=format&fit=crop',
                'description' => 'Lapangan badminton private dengan AC penuh untuk pengalaman bermain eksklusif.',
                'facilities' => ['Private Court', 'Full AC', 'Private Changing Room', 'Free Mineral Water']
            ],
            // BASKETBALL COURTS
            7 => [
                'name' => 'Basketball Court 1',
                'type' => 'Lapangan Outdoor Plester Halus',
                'price' => 100000,
                'image' => 'https://images.unsplash.com/photo-1546519638-68e109498ffc?q=80&w=2690&auto=format&fit=crop',
                'description' => 'Lapangan basket outdoor standar, cocok untuk latihan sore.',
                'facilities' => ['Ring Standar', 'Outdoor Area', 'Penerangan Sore', 'Scoreboard Manual']
            ],
            8 => [
                'name' => 'Basketball Court 2',
                'type' => 'Lantai Vinyl Sport',
                'price' => 150000,
                'image' => 'https://images.unsplash.com/photo-1505666287802-93144f1756d3?q=80&w=2574&auto=format&fit=crop',
                'description' => 'Lapangan indoor dengan lantai vinyl khusus olahraga basket.',
                'facilities' => ['Full Indoor', 'Anti-Slip Vinyl', 'Changing Room', 'Lampu LED Terang']
            ],
            9 => [
                'name' => 'Basketball Court 3',
                'type' => 'Parquet Kayu FIBA Standard',
                'price' => 250000,
                'image' => 'https://images.unsplash.com/photo-1504450758481-7338eba7524a?q=80&w=2669&auto=format&fit=crop',
                'description' => 'Lapangan standar NBA/FIBA dengan lantai kayu parket terbaik.',
                'facilities' => ['FIBA Standard', 'Pro Rings', 'AC + VVIP Lounge', 'Tribune Seating']
            ]
        ];

        // Fallback or use DB data if needed, but per request we strictly force visual consistency
        // Check if the field ID exists in the hardcoded config
        if (array_key_exists($field->id, $fieldsConfig)) {
            $currentField = $fieldsConfig[$field->id];
        } else {
            // Dynamic fallback using DB data for new fields
            $currentField = [
                'name' => $field->name,
                'type' => ucfirst($field->category) . ' Court Standard', // Default type based on category
                'price' => $field->price_per_hour,
                'image' => $field->image_path ?? 'https://via.placeholder.com/800x600?text=No+Image',
                'description' => $field->description ?? 'Deskripsi belum tersedia for this field.',
                'facilities' => ['Standar Fasilitas', 'Penerangan LED', 'Area Istirahat'] // GENERIC DEFAULTS
            ];
        }
    @endphp

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Lapangan & Booking') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="bookingSystem({{ $currentField['price'] }}, {{ json_encode($unavailableSlots) }})">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column: Field Detail & Schedule -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Field Details -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="h-64 md:h-80 relative">
                            <img src="{{ $currentField['image'] }}" class="w-full h-full object-cover"
                                alt="{{ $currentField['name'] }}">
                        </div>
                        <div class="p-6 md:p-8">
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $currentField['name'] }}</h1>
                            <div class="flex items-center text-gray-500 mb-6 text-sm">
                                <svg class="w-5 h-5 mr-2 text-emerald-500" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $currentField['type'] }}
                            </div>

                            <h3 class="font-semibold text-lg text-gray-800 mb-3">Fasilitas</h3>
                            <ul class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-600 mb-6">
                                @foreach($currentField['facilities'] as $facility)
                                    <li class="flex items-center space-x-2">
                                        <span class="text-emerald-500">✓</span> <span>{{ $facility }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Schedule Grid -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Jadwal Ketersediaan</h3>
                            <div class="flex space-x-4 mt-4 md:mt-0 text-sm">
                                <div class="flex items-center"><span
                                        class="w-3 h-3 rounded-full bg-emerald-100 border border-emerald-500 mr-2"></span>
                                    Kosong</div>
                                <div class="flex items-center"><span
                                        class="w-3 h-3 rounded-full bg-red-100 border border-red-500 mr-2"></span>
                                    Terisi</div>
                                <div class="flex items-center"><span
                                        class="w-3 h-3 rounded-full bg-yellow-100 border border-yellow-500 mr-2"></span>
                                    Dipilih</div>
                            </div>
                        </div>

                        <!-- Date Picker -->
                        <div class="mb-6">
                            <form method="GET" action="{{ route('booking.show', $field->id) }}">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Booking</label>
                                <div class="flex gap-2">
                                    <input type="date" name="date" value="{{ $date }}" class="block w-full md:w-1/3 rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm">Check</button>
                                </div>
                            </form>
                        </div>

                        <!-- Slots -->
                        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-3">
                            @foreach(['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00'] as $time)
                                @php
                                    // Check if slot is unavailable (either booked or blocked)
                                    // We'll use the array passed from controller
                                    $isUnavailable = in_array($time, $unavailableSlots);
                                @endphp
                                <button 
                                    @click="toggleSlot('{{ $time }}', {{ $isUnavailable ? 'true' : 'false' }})"
                                    :class="{
                                        'bg-emerald-50 border-emerald-200 text-emerald-700 hover:bg-emerald-100': !{{ $isUnavailable ? 'true' : 'false' }} && !selectedSlots.includes('{{ $time }}'),
                                        'bg-red-50 border-red-200 text-red-500 cursor-not-allowed opacity-75': {{ $isUnavailable ? 'true' : 'false' }},
                                        'bg-yellow-50 border-yellow-400 text-yellow-700 ring-2 ring-yellow-400': selectedSlots.includes('{{ $time }}')
                                    }"
                                    class="py-3 text-sm font-medium rounded-lg border transition-all duration-200 flex flex-col items-center justify-center">
                                    <span>{{ $time }}</span>
                                    <span class="text-[10px] mt-1 font-normal">
                                        @if($isUnavailable)
                                            Terisi
                                        @else
                                            <span x-text="selectedSlots.includes('{{ $time }}') ? 'Dipilih' : '{{ number_format($currentField['price'] / 1000, 0) }}k'"></span>
                                        @endif
                                    </span>
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
                                <span class="font-medium text-gray-900 text-right">{{ $currentField['name'] }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Harga/Jam</span>
                                <span class="font-medium text-gray-900">Rp
                                    {{ number_format($currentField['price'], 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Tanggal</span>
                                <span class="font-medium text-gray-900">{{ Carbon\Carbon::parse($date)->isoFormat('D MMMM Y') }}</span>
                            </div>
                            <div class="border-t border-gray-100 pt-3">
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="text-gray-500">Total Durasi</span>
                                    <span class="font-medium text-gray-900"><span x-text="selectedSlots.length">0</span>
                                        Jam</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-base font-bold text-gray-900">Total Harga</span>
                                    <span class="text-xl font-bold text-emerald-600">Rp <span
                                            x-text="(selectedSlots.length * pricePerHour).toLocaleString('id-ID')">0</span></span>
                                </div>
                            </div>
                        </div>

                        <!-- Form Action -->
                        <form action="{{ route('booking.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="field_id" value="{{ $field->id }}">
                            <input type="hidden" name="date" value="{{ $date }}">
                            
                            <!-- Hidden inputs populated by Alpine -->
                            <input type="hidden" name="start_time" :value="startTime">
                            <input type="hidden" name="duration" :value="duration">
                            
                            <!-- Errors -->
                            @if(session('error'))
                                <div class="mb-4 text-sm text-red-600">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <button type="submit" :disabled="selectedSlots.length === 0"
                                :class="{'opacity-50 cursor-not-allowed': selectedSlots.length === 0}"
                                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-emerald-200 transform transition hover:-translate-y-0.5">
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
        function bookingSystem(price, serverUnavailableSlots) {
            return {
                unavailableSlots: serverUnavailableSlots || [],
                selectedSlots: [],
                pricePerHour: price,
                get startTime() {
                    if (this.selectedSlots.length === 0) return '';
                    let sorted = [...this.selectedSlots].sort();
                    return sorted[0];
                },
                get duration() {
                    return this.selectedSlots.length;
                },
                toggleSlot(time, isUnavailable) {
                    if (isUnavailable) return;
                    if (this.selectedSlots.includes(time)) {
                        this.selectedSlots = this.selectedSlots.filter(t => t !== time);
                    } else {
                        // Optional: Check if contiguous? 
                        this.selectedSlots.push(time);
                    }
                    this.selectedSlots.sort();
                }
            }
        }
    </script>
</x-app-layout>