<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Riwayat Booking
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-100 text-gray-600 uppercase">
                        <tr>
                            <th class="px-6 py-3">Lapangan</th>
                            <th class="px-6 py-3">Tanggal</th>
                            <th class="px-6 py-3">Total Harga</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse ($bookings as $booking)
                            <tr>
                                <td class="px-6 py-4">
                                    {{ $booking->field->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $booking->start_time->format('d M Y, H:i') }}
                                </td>
                                <td class="px-6 py-4">
                                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        @if(in_array($booking->status, ['approved', 'paid'])) bg-green-100 text-green-700
                                        @elseif($booking->status === 'pending') bg-yellow-100 text-yellow-700
                                        @else bg-red-100 text-red-700 @endif">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($booking->status === 'pending')
                                        <a href="{{ route('booking.payment', $booking->id) }}" 
                                           class="inline-block bg-emerald-600 text-white text-xs font-bold px-4 py-2 rounded-lg hover:bg-emerald-700 transition shadow-sm">
                                            Bayar Sekarang
                                        </a>
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-6 text-center text-gray-500">
                                    Belum ada riwayat booking.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>