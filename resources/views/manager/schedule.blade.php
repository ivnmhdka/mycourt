<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Jadwal Lapangan') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="scheduleManager({{ json_encode($blockedSlots) }}, {{ json_encode($bookedSlots) }})">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    @if(session('success'))
                        <div class="mb-6 bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <!-- Filters Form -->
                    <form method="GET" action="{{ route('manager.schedule') }}" class="flex flex-col md:flex-row gap-4 mb-8 items-end">
                        <div class="w-full md:w-1/3">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Lapangan</label>
                            <select name="field_id" onchange="this.form.submit()" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                @foreach($fields as $field)
                                    <option value="{{ $field->id }}" {{ $fieldId == $field->id ? 'selected' : '' }}>
                                        {{ $field->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full md:w-1/3">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                            <input type="date" name="date" value="{{ $date }}" onchange="this.form.submit()" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        </div>
                    </form>

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
                        <div class="flex items-center text-sm">
                            <span class="w-4 h-4 rounded mr-2" style="background-color: rgba(250, 204, 21, 0.25); border: 1px solid rgba(250, 204, 21, 0.8);"></span>
                            <span class="line-through decoration-red-500 decoration-2 text-gray-500">Pending Cancel</span> (Save untuk Hapus)
                        </div>
                    </div>

                    <!-- Main Form to Save Changes -->
                    <form method="POST" action="{{ route('manager.schedule.update') }}">
                        @csrf
                        <input type="hidden" name="field_id" value="{{ $fieldId }}">
                        <input type="hidden" name="date" value="{{ $date }}">

                        <!-- Hidden Inputs for Blocked Slots -->
                        <template x-for="time in blockedSlots">
                            <input type="hidden" name="blocked_slots[]" :value="time">
                        </template>
                        
                        <!-- Hidden Inputs for Cancelled Bookings -->
                        <template x-for="time in cancelledBookings">
                            <input type="hidden" name="cancelled_bookings[]" :value="time">
                        </template>

                        

                        <!-- Grid -->
                        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-4">
                            @foreach(['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00'] as $time)
                                @php
                                    $bookingInfo = $bookedSlots[$time] ?? null;
                                    $isBooked = !is_null($bookingInfo);
                                    $userName = $bookingInfo['user_name'] ?? '';
                                @endphp
                                
                                <button 
                                    type="button"
                                    @click="toggleBlock('{{ $time }}', {{ $isBooked ? 'true' : 'false' }})"
                                    class="relative border rounded-xl p-4 flex flex-col items-center justify-between h-32 transition-all duration-200 w-full focus:outline-none hover:shadow-md"
                                    :class="getSlotClass('{{ $time }}', {{ $isBooked ? 'true' : 'false' }})"
                                    :style="getSlotStyle('{{ $time }}')"
                                >
                                    <div class="absolute top-2 right-2" x-show="blockedSlots.includes('{{ $time }}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 6.524a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd" />
                                        </svg>
                                    </div>

                                    @if($isBooked)
                                    <div class="absolute top-2 right-2" x-show="!blockedSlots.includes('{{ $time }}') && !cancelledBookings.includes('{{ $time }}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                    </div>
                                    @endif

                                    
                                    <span class="font-bold text-lg text-gray-700">{{ $time }}</span>
                                    
                                    <!-- Status Badge -->
                                    <div class="mt-2 text-center w-full">
                                        @if($isBooked)
                                            <!-- Logic Disini agak tricky: Default Booked (Red) -->
                                            <!-- Tapi kalo ada di cancelledBookings, Tampilan berubah jadi Orange/Strikethrough -->
                                            
                                            <div x-show="!cancelledBookings.includes('{{ $time }}')" class="flex flex-col items-center">
                                                <span class="text-xs font-bold text-red-600 uppercase">Booked</span>
                                                <span class="text-[10px] text-gray-600 truncate font-semibold w-full px-1">{{ $userName }}</span>
                                                <span class="text-[9px] text-red-400 leading-tight">(Klik Override)</span>
                                            </div>

                                            <div x-show="cancelledBookings.includes('{{ $time }}')" class="flex flex-col items-center opacity-75">
                                                <span class="text-xs font-bold text-red-800 uppercase line-through decoration-2">Booked</span>
                                                <span class="text-[10px] text-gray-800 truncate font-bold w-full px-1 line-through decoration-red-500 decoration-2">{{ $userName }}</span>
                                                <span class="text-[9px] text-yellow-800 font-bold leading-tight mt-1 bg-yellow-100 border border-yellow-300 px-1 rounded">AKAN DIHAPUS</span>
                                            </div>
                                            
                                            <span x-show="blockedSlots.includes('{{ $time }}') && !cancelledBookings.includes('{{ $time }}')" class="text-xs font-bold text-gray-700 uppercase">Blocked</span>
                                        @else
                                            <span x-show="blockedSlots.includes('{{ $time }}')" class="text-xs font-bold text-gray-700 uppercase">Blocked</span>
                                            <span x-show="!blockedSlots.includes('{{ $time }}')" class="text-xs font-bold text-emerald-600 uppercase">Open</span>
                                        @endif
                                    </div>
                                </button>
                            @endforeach
                        </div>

                        <div class="mt-8 flex justify-end">
                            <button type="submit" class="bg-emerald-600 text-white px-6 py-2 rounded-lg font-bold shadow-lg hover:bg-emerald-700 transition">
                                Simpan Perubahan Jadwal
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>




        <!-- Booking Detail Modal -->
        <x-modal name="booking-detail" focusable>
            <div class="p-6 bg-white rounded-lg">
                <div class="flex justify-between items-start mb-6">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-red-100 rounded-full">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900">
                            Detail & Pembatalan
                        </h2>
                    </div>
                    <button @click="$dispatch('close')" class="text-gray-400 hover:text-gray-600 transition">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="space-y-6" x-show="selectedBooking">
                    <!-- Ticket-like Info Card -->
                    <div class="bg-gray-50 border border-gray-100 rounded-2xl p-6 shadow-sm relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-500 rounded-bl-full opacity-[0.08]"></div>
                        
                        <div class="grid grid-cols-2 gap-6 relative z-10">
                             <div class="flex flex-col">
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Nama Penyewa</h3>
                                <p class="text-xl font-bold text-gray-800 mt-2 truncate" x-text="selectedBooking?.user_name"></p>
                            </div>
                             <div class="flex flex-col text-right">
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Waktu Booking</h3>
                                <p class="text-xl font-bold text-emerald-600 mt-2" x-text="selectedBooking?.time"></p>
                            </div>
                             <div class="col-span-2 border-t border-gray-200 pt-4 flex justify-between items-center">
                                <div class="flex flex-col">
                                    <span class="text-[10px] uppercase text-gray-400 font-bold tracking-wider">Booking ID</span>
                                    <span class="font-mono text-sm text-gray-600" x-text="'#' + selectedBooking?.id"></span>
                                </div>
                                <span class="px-3 py-1.5 bg-red-100 text-red-700 text-xs font-extrabold rounded-lg uppercase tracking-wide">
                                    ● Booked
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Warning Text -->
                    <div class="flex items-start gap-4 p-4 bg-amber-50 rounded-xl border border-amber-100/50">
                        <div class="p-2 bg-amber-100 rounded-full flex-shrink-0">
                             <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <div class="text-sm text-amber-900 leading-relaxed pt-1">
                            <strong>Konfirmasi Override:</strong> Slot ini akan ditandai <span class="font-bold underline decoration-amber-400">Pending Cancel</span>. 
                            Pastikan Anda sudah mengonfirmasi dengan penyewa sebelum melanjutkan.
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <button x-on:click="$dispatch('close')" class="px-6 py-3 rounded-xl border-2 border-gray-200 text-gray-700 font-bold hover:bg-gray-50 hover:border-gray-300 transition focus:ring-4 focus:ring-gray-100">
                        Batal
                    </button>
                    <button x-on:click="cancelSelectedBooking()" class="px-6 py-3 rounded-xl bg-red-600 text-white font-bold shadow-lg shadow-red-200 hover:bg-red-700 hover:shadow-xl transition transform active:scale-95 flex items-center gap-2 focus:ring-4 focus:ring-red-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        <span>Override & Hapus</span>
                    </button>
                </div>
            </div>
        </x-modal>

        

    </div>

    <script>
        function scheduleManager(initialBlockedSlots, initialBookedSlots) {
            return {
                blockedSlots: initialBlockedSlots || [],
                bookedSlots: initialBookedSlots || {}, 
                cancelledBookings: [],
                selectedBooking: null, 
                
                getSlotClass(time, isBookedOriginal) {
                    // 1. Check if Pending Cancel (Amber) -> Highest Priority for Feedback
                    if (this.cancelledBookings.includes(time)) {
                        return 'shadow-md ring-2';
                    }

                    // 2. Check if Booked (Red)
                    if (isBookedOriginal) {
                        return 'bg-red-50 border-red-200 hover:bg-red-100'; 
                    }

                    // 3. Check if Blocked (Gray)
                    if (this.blockedSlots.includes(time)) {
                        return 'bg-gray-200 border-gray-400 hover:bg-gray-300';
                    }

                    // 4. Default: Open (Emerald)
                    return 'bg-emerald-50 border-emerald-200 hover:bg-emerald-100';
                },

                getSlotStyle(time) {
                    if (this.cancelledBookings.includes(time)) {
                        // Yellow 400 (rgba) for nice transparency
                        return 'background-color: rgba(250, 204, 21, 0.25) !important; border-color: rgba(250, 204, 21, 0.8) !important; --tw-ring-color: rgba(250, 204, 21, 0.6) !important;';
                    }
                    return '';
                },

                toggleBlock(time, isBooked) {
                    if (isBooked) {
                        if (this.cancelledBookings.includes(time)) {
                            this.cancelledBookings = this.cancelledBookings.filter(t => t !== time);
                            return;
                        }

                        // Open Modal
                        let bookingData = this.bookedSlots[time];
                        this.selectedBooking = {
                            time: time,
                            id: bookingData ? bookingData.id : '-',
                            user_name: bookingData ? bookingData.user_name : 'Unknown'
                        };
                        
                        window.dispatchEvent(new CustomEvent('open-modal', { detail: 'booking-detail' }));
                        return;
                    }
                    
                    if (this.blockedSlots.includes(time)) {
                        this.blockedSlots = this.blockedSlots.filter(t => t !== time);
                    } else {
                        this.blockedSlots.push(time);
                    }
                },

                cancelSelectedBooking() {
                    if (!this.selectedBooking) return;
                    let time = this.selectedBooking.time;
                    
                    if (!this.cancelledBookings.includes(time)) {
                        this.cancelledBookings.push(time);
                    }
                    if (this.blockedSlots.includes(time)) {
                        this.blockedSlots = this.blockedSlots.filter(t => t !== time);
                    }

                    window.dispatchEvent(new CustomEvent('close-modal', { detail: 'booking-detail' }));
                    this.selectedBooking = null;
                }
            }
        }
    </script>
</x-app-layout>
