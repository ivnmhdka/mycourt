<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Left Column: QRIS -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-bold mb-4 text-center">Scan QRIS</h3>
                        <div class="flex flex-col items-center justify-center">
                            <div class="border-2 border-gray-200 rounded-lg p-4 mb-4">
                                <!-- Placeholder for QRIS -->
                                <img src="https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg" alt="QRIS Code" class="w-64 h-64 object-contain">
                            </div>
                            <p class="text-sm text-gray-500 text-center mb-2">Scan QRIS di atas untuk menyelesaikan pembayaran</p>
                            <p class="text-xs text-gray-400 text-center">OVO / GoPay / Dana / LinkAja / Mobile Banking</p>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Summary -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-bold mb-6">Ringkasan Booking</h3>
                        
                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <span class="text-gray-600">Lapangan</span>
                                <span class="font-medium">{{ $booking->field->name ?? 'Lapangan Futsal' }}</span>
                            </div>
                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <span class="text-gray-600">Tanggal</span>
                                <span class="font-medium">{{ $booking->start_time->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <span class="text-gray-600">Jam</span>
                                <span class="font-medium">{{ $booking->start_time->format('H:i') }} - {{ $booking->end_time->format('H:i') }}</span>
                            </div>
                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <span class="text-gray-600">Durasi</span>
                                <span class="font-medium">{{ $booking->start_time->diffInHours($booking->end_time) }} Jam</span>
                            </div>
                            
                            <div class="flex justify-between items-center pt-4">
                                <span class="text-lg font-bold">Total Harga</span>
                                <span class="text-2xl font-bold text-emerald-600">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <form action="{{ route('booking.pay', $booking->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg transition duration-150 ease-in-out">
                                Sudah Bayar
                            </button>
                            <p class="text-xs text-center text-gray-500 mt-3">
                                Klik tombol di atas jika Anda sudah melakukan pembayaran.
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
