<x-app-layout>
    <!-- Hero Section -->
    <div class="relative bg-emerald-700 overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <img src="https://images.unsplash.com/photo-1541534741688-6078c6bfb5c5?q=80&w=2669&auto=format&fit=crop"
                class="w-full h-full object-cover" alt="Sports Court Background">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32 text-center text-white">
            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight mb-6">
                Booking Lapangan,<br /> <span class="text-emerald-300">Tanpa Ribet.</span>
            </h1>
            <p class="mt-4 max-w-2xl mx-auto text-xl text-emerald-100">
                Temukan dan sewa lapangan olahraga favoritmu secara real-time. Futsal, Basket, Badminton, semua ada di
                sini.
            </p>

            <!-- Search Widget Mockup -->
            <div class="mt-10 max-w-4xl mx-auto bg-white rounded-xl shadow-2xl p-4 md:p-6 text-left">
                <form action="#" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="col-span-1 md:col-span-2 relative">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Cari
                            Lapangan / Cabang</label>
                        <input type="text" placeholder="Misal: Futsal Center Kemang"
                            class="w-full border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 font-semibold text-gray-800">
                    </div>
                    <div class="col-span-1 relative">
                        <label
                            class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Tanggal</label>
                        <input type="date"
                            class="w-full border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 font-semibold text-gray-800">
                    </div>
                    <div class="col-span-1 flex items-end">
                        <a href="{{ route('register') }}"
                            class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-4 rounded-lg shadow-lg transform transition hover:-translate-y-0.5 text-center flex items-center justify-center">
                            Cari Jadwal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Features / Highlights -->
    <div class="bg-gray-50 py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-base text-emerald-600 font-semibold tracking-wide uppercase">Kenapa MyCourt?</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Solusi Olahraga Modern
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Feature 1 -->
                <div
                    class="bg-white rounded-lg shadow-md p-8 text-center hover:shadow-xl transition-shadow duration-300">
                    <div
                        class="mx-auto flex items-center justify-center h-12 w-12 rounded-md bg-emerald-500 text-white mb-6">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Real Time Schedule</h3>
                    <p class="text-gray-500">Cek ketersediaan lapangan secara langsung tanpa perlu telepon atau chat
                        admin.</p>
                </div>

                <!-- Feature 2 -->
                <div
                    class="bg-white rounded-lg shadow-md p-8 text-center hover:shadow-xl transition-shadow duration-300">
                    <div
                        class="mx-auto flex items-center justify-center h-12 w-12 rounded-md bg-emerald-500 text-white mb-6">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Payment Gateway</h3>
                    <p class="text-gray-500">Bayar DP atau lunas dengan mudah lewat transfer bank, e-wallet, atau QRIS.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div
                    class="bg-white rounded-lg shadow-md p-8 text-center hover:shadow-xl transition-shadow duration-300">
                    <div
                        class="mx-auto flex items-center justify-center h-12 w-12 rounded-md bg-emerald-500 text-white mb-6">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Instant Confirmation</h3>
                    <p class="text-gray-500">Dapatkan bukti booking digital (E-Ticket) segera setelah pembayaran
                        terverifikasi.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-emerald-600">
        <div
            class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between">
            <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl text-center md:text-left">
                <span class="block">Siap untuk bermain?</span>
                <span class="block text-emerald-200">Daftar sekarang dan booking lapanganmu.</span>
            </h2>
            <div class="mt-8 md:mt-0 flex justify-center">
                <div class="inline-flex rounded-md shadow">
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-emerald-600 bg-white hover:bg-emerald-50">
                        Buat Akun Gratis
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>