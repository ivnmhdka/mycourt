<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Data Booking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <!-- Search & Filter -->
                    <div class="flex flex-col sm:flex-row justify-between mb-6 gap-4">
                        <div class="flex-1">
                            <input type="text" placeholder="Cari nama atau ID Booking..." class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        </div>
                        <div>
                            <select class="rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                <option>Semua Status</option>
                                <option>Pending</option>
                                <option>Lunas</option>
                                <option>Ditolak</option>
                            </select>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User Info</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Detail Booking</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bukti Bayar</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Row 1 (Pending) -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#BK001</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-gray-900">Budi Santoso</div>
                                        <div class="text-sm text-gray-500">081234567890</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Futsal 1</div>
                                        <div class="text-xs text-gray-500">15 Des, 20:00-22:00</div>
                                        <div class="text-xs font-semibold text-emerald-600">Rp 240.000</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="#" class="text-blue-600 hover:underline text-sm flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                            Lihat Bukti
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-white bg-green-600 hover:bg-green-700 px-3 py-1 rounded-md text-xs mr-2 transition">Approve</button>
                                        <button class="text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded-md text-xs transition">Reject</button>
                                    </td>
                                </tr>

                                <!-- Row 2 (Approved) -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#BK002</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-gray-900">Siti Aminah</div>
                                        <div class="text-sm text-gray-500">081122334455</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Badminton A</div>
                                        <div class="text-xs text-gray-500">16 Des, 10:00-11:00</div>
                                        <div class="text-xs font-semibold text-emerald-600">Rp 80.000</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="#" class="text-blue-600 hover:underline text-sm flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                            Lihat Bukti
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Approved
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <span class="text-gray-400 cursor-not-allowed">Selesai</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4 flex justify-between items-center text-sm text-gray-600">
                        <div>Menampilkan 1-2 dari 2 booking</div>
                        <div class="flex space-x-1">
                            <button class="px-3 py-1 border rounded hover:bg-gray-50 disabled:opacity-50">Prev</button>
                            <button class="px-3 py-1 border rounded hover:bg-gray-50">Next</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
