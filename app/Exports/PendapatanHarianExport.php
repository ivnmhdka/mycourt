<?php

namespace App\Exports;

use App\Models\Booking;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PendapatanHarianExport implements FromCollection, WithHeadings, WithMapping
{
    protected $request;
    protected $no = 0;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $periode = $this->request->periode ?? 'harian';

        $query = Booking::with(['user', 'field'])
            ->whereIn('status', ['approved', 'paid']);

        // ======================
        // HARIAN
        // ======================
        if ($periode === 'harian') {
            $tanggal = $this->request->tanggal
                ? Carbon::parse($this->request->tanggal)->startOfDay()
                : Carbon::today()->startOfDay();

            $query->whereDate('created_at', $tanggal);
        }

        // ======================
        // MINGGUAN (RANGE)
        // ======================
        elseif ($periode === 'mingguan') {
            $start = Carbon::parse($this->request->start_date)->startOfDay();
            $end   = Carbon::parse($this->request->end_date)->endOfDay(); // 🔥 FIX

            $query->whereBetween('created_at', [$start, $end]);
        }

        // ======================
        // BULANAN (YYYY-MM)
        // ======================
        elseif ($periode === 'bulanan') {
            [$tahun, $bulan] = explode('-', $this->request->bulan);

            $query->whereYear('created_at', $tahun)
                  ->whereMonth('created_at', $bulan);
        }

        return $query->orderBy('created_at', 'asc')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal',
            'User',
            'Lapangan',
            'Total (Rp)',
        ];
    }

    public function map($booking): array
    {
        return [
            ++$this->no,
            $booking->created_at->format('d-m-Y'),
            $booking->user->name ?? '-',
            $booking->field->name ?? '-',
            $booking->total_price,
        ];
    }
}
