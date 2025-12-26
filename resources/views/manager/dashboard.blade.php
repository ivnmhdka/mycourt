<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Pengelola') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Card 1 -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border-l-4 border-yellow-400">
                    <div class="p-6">
                        <div class="text-gray-500 text-sm font-medium">Booking Pending</div>
                        <div class="flex items-center mt-2">
                             <div class="text-3xl font-bold text-gray-800">12</div>
                             <span class="ml-2 text-xs bg-yellow-100 text-yellow-700 rounded-full px-2 py-0.5">Butuh Aksi</span>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border-l-4 border-emerald-500">
                    <div class="p-6">
                        <div class="text-gray-500 text-sm font-medium">Booking Hari Ini</div>
                        <div class="flex items-center mt-2">
                             <div class="text-3xl font-bold text-gray-800">8</div>
                             <span class="ml-2 text-xs bg-emerald-100 text-emerald-700 rounded-full px-2 py-0.5">+2 dari kemarin</span>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border-l-4 border-blue-500">
                    <div class="p-6">
                        <div class="text-gray-500 text-sm font-medium">Pendapatan Hari Ini</div>
                        <div class="flex items-center mt-2">
                             <div class="text-3xl font-bold text-gray-800">Rp {{ number_format($todayIncome ?? 0, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            </div>

{{-- PANEL LAPORAN PENDAPATAN --}}
<div class="mb-8">
    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
        <div class="p-6 flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-900">
                    Laporan Pendapatan
                </h3>
                <p class="text-sm text-gray-500">
                    Cetak laporan pendapatan lapangan dalam format PDF atau Excel
                </p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('manager.laporan.pendapatan.pdf') }}"
                   class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md
                          font-semibold text-xs text-white uppercase tracking-widest
                          hover:bg-red-700 active:bg-red-900 focus:outline-none focus:ring
                          focus:ring-red-300 transition">
                    Cetak PDF
                </a>

                <a href="{{ route('manager.laporan.pendapatan.excel') }}"
                   class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md
                          font-semibold text-xs text-white uppercase tracking-widest
                          hover:bg-emerald-700 active:bg-emerald-900 focus:outline-none focus:ring
                          focus:ring-emerald-300 transition">
                    Export Excel
                </a>
            </div>
        </div>
    </div>
</div>


            <!-- Recent Bookings Table -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Booking Masuk Terbaru</h3>
                        <a href="{{ url('/manager/bookings') }}" class="text-sm text-emerald-600 hover:text-emerald-800 font-medium">Lihat Semua →</a>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lapangan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jadwal</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Mock Data Row 1 -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">Budi Santoso</div>
                                        <div class="text-sm text-gray-500">081234567890</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Futsal 1 (Vinyl)</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">15 Des 2023</div>
                                        <div class="text-sm text-gray-500">20:00 - 22:00 (2 Jam)</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="#" class="text-emerald-600 hover:text-emerald-900">Verifikasi</a>
                                    </td>
                                </tr>
                                <!-- Mock Data Row 2 -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">Andi Pratama</div>
                                        <div class="text-sm text-gray-500">089876543210</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Badminton A</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">16 Des 2023</div>
                                        <div class="text-sm text-gray-500">10:00 - 11:00 (1 Jam)</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Lunas
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <span class="text-gray-400">Selesai</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
