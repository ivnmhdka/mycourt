<x-app-layout>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow rounded-lg sm:px-10 text-center">
                <div class="mb-6 flex justify-center">
                    <div class="rounded-full bg-green-100 p-3">
                        <svg class="h-12 w-12 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
                
                <h2 class="text-2xl font-bold text-gray-900 mb-2">
                    Pembayaran Berhasil!
                </h2>
                <p class="text-gray-600 mb-8">
                    Terima kasih, booking Anda telah terkonfirmasi.
                </p>

                <div class="border-t border-gray-200 pt-6">
                    <div class="mb-4 text-sm text-gray-500">
                        Kode Booking: <span class="font-mono font-bold text-gray-900">#{{ $booking->id }}</span>
                    </div>
                    
                    <a href="{{ route('dashboard') }}" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
