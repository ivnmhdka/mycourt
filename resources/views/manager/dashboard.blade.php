<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Pengelola') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

                <!-- Card 2 -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border-l-4 border-emerald-500">
                    <div class="p-6">
                        <div class="text-gray-500 text-sm font-medium">Booking Hari Ini</div>
                        <div class="flex items-center mt-2">
                            <div class="text-3xl font-bold text-gray-800">{{ $todayBookings ?? 0 }}</div>
                            <span class="ml-2 text-xs bg-emerald-100 text-emerald-700 rounded-full px-2 py-0.5">Booking
                                Masuk</span>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border-l-4 border-blue-500">
                    <div class="p-6">
                        <div class="text-gray-500 text-sm font-medium">Pendapatan Hari Ini</div>
                        <div class="flex items-center mt-2">
                            <div class="text-3xl font-bold text-gray-800">Rp
                                {{ number_format($todayIncome ?? 0, 0, ',', '.') }}</div>
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

                        <div class="flex gap-3 items-end">

                            <!-- PERIODE -->
                            <div>
                                <label class="text-xs text-gray-600">Periode</label>
                                <select id="periode" class="rounded-md text-sm">
                                    <option value="harian">Harian</option>
                                    <option value="mingguan">Mingguan</option>
                                    <option value="bulanan">Bulanan</option>
                                </select>
                            </div>

                            <!-- HARIAN -->
                            <div id="filter-harian">
                                <label class="text-xs text-gray-600">Tanggal</label>
                                <input type="date" id="tanggal" class="rounded-md text-sm"
                                    value="{{ date('Y-m-d') }}">
                            </div>

                            <!-- MINGGUAN -->
                            <div id="filter-mingguan" class="hidden">
                                <label class="text-xs text-gray-600">Range</label>
                                <div class="flex gap-1">
                                    <input type="date" id="start_date" class="rounded-md text-sm">
                                    <input type="date" id="end_date" class="rounded-md text-sm">
                                </div>
                            </div>

                            <!-- BULANAN -->
                            <div id="filter-bulanan" class="hidden">
                                <label class="text-xs text-gray-600">Bulan</label>
                                <input type="month" id="bulan" class="rounded-md text-sm">
                            </div>

                            <!-- PDF -->
                            <a id="btnPdf"
                            href="{{ route('manager.laporan.pendapatan.pdf') }}"
                            target="_blank"
                            class="inline-flex items-center px-4 py-2 bg-red-600 rounded-md text-xs text-white font-semibold
                                    hover:bg-red-700 transition">
                                Cetak PDF
                            </a>

                            <!-- EXCEL -->
                            <a id="btnExcel"
                            href="{{ route('manager.laporan.pendapatan.excel') }}"
                            class="inline-flex items-center px-4 py-2 bg-emerald-600 rounded-md text-xs text-white font-semibold
                                    hover:bg-emerald-700 transition">
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
                        <a href="{{ url('/manager/bookings') }}"
                            class="text-sm text-emerald-600 hover:text-emerald-800 font-medium">Lihat Semua →</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        User</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Lapangan</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Jadwal</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($recentBookings as $booking)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $booking->user->name ?? 'Guest' }}</div>
                                            <div class="text-sm text-gray-500">{{ $booking->user->email ?? '-' }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $booking->field->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $booking->start_time->format('d M Y') }}
                                            </div>
                                            <div class="text-sm text-gray-500">{{ $booking->start_time->format('H:i') }} -
                                                {{ $booking->end_time->format('H:i') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $statusClasses = [
                                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                                    'paid' => 'bg-emerald-100 text-emerald-800',
                                                    'approved' => 'bg-emerald-100 text-emerald-800',
                                                    'rejected' => 'bg-red-100 text-red-800',
                                                    'cancelled' => 'bg-gray-100 text-gray-800',
                                                ];
                                                $class = $statusClasses[$booking->status] ?? 'bg-gray-100 text-gray-800';
                                            @endphp
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $class }}">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('manager.bookings', ['search' => $booking->id]) }}"
                                                class="text-emerald-600 hover:text-emerald-900">Detail</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"
                                            class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                            Belum ada booking terbaru.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
const periode = document.getElementById('periode');

const harian   = document.getElementById('filter-harian');
const mingguan = document.getElementById('filter-mingguan');
const bulanan  = document.getElementById('filter-bulanan');

const btnPdf   = document.getElementById('btnPdf');
const btnExcel = document.getElementById('btnExcel');

function updateButtons() {
    let params = new URLSearchParams();
    params.append('periode', periode.value);

    if (periode.value === 'harian') {
        params.append('tanggal', document.getElementById('tanggal').value);
    }

    if (periode.value === 'mingguan') {
        params.append('start_date', document.getElementById('start_date').value);
        params.append('end_date', document.getElementById('end_date').value);
    }

    if (periode.value === 'bulanan') {
        params.append('bulan', document.getElementById('bulan').value);
    }

    btnPdf.href   = `{{ route('manager.laporan.pendapatan.pdf') }}?${params.toString()}`;
    btnExcel.href = `{{ route('manager.laporan.pendapatan.excel') }}?${params.toString()}`;
}

periode.addEventListener('change', () => {
    harian.classList.add('hidden');
    mingguan.classList.add('hidden');
    bulanan.classList.add('hidden');

    if (periode.value === 'harian') harian.classList.remove('hidden');
    if (periode.value === 'mingguan') mingguan.classList.remove('hidden');
    if (periode.value === 'bulanan') bulanan.classList.remove('hidden');

    updateButtons();
});

document.querySelectorAll('#tanggal, #start_date, #end_date, #bulan')
    .forEach(el => el?.addEventListener('change', updateButtons));

// init
updateButtons();
</script>

</x-app-layout>