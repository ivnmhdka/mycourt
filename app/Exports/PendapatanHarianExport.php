<?php

namespace App\Exports;

use App\Models\Booking;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PendapatanHarianExport implements FromCollection, WithHeadings, WithMapping
{
    protected $no = 0;

    public function collection()
    {
        $today = Carbon::today();

        return Booking::with(['user', 'field'])
            ->whereDate('created_at', $today)
            ->where('status', 'paid')
            ->orderBy('created_at', 'asc')
            ->get();
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
