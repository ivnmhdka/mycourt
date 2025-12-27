<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PendapatanHarianExport;
use Maatwebsite\Excel\Facades\Excel;


class ManagerController extends Controller
{
    public function dashboard()
    {
        $today = Carbon::today();

        // Booking pending
        $pendingCount = Booking::where('status', 'pending')->count();

        // Booking hari ini (berdasarkan jadwal main)
        $todayBookings = Booking::whereDate('created_at', today())
                ->where('status', 'paid')
                ->sum('total_price');


        // 🔥 PENDAPATAN HARI INI (INI INTINYA)
        $todayIncome = Booking::whereDate('created_at', $today)
            ->where('status', 'paid')
            ->sum('total_price');

        // Booking terbaru
        $recentBookings = Booking::with(['user', 'field'])
            ->latest()
            ->take(5)
            ->get();

        return view('manager.dashboard', compact(
            'pendingCount',
            'todayBookings',
            'todayIncome',
            'recentBookings'
        ));
    }

    public function index(Request $request)
    {
        $query = Booking::with(['user', 'field'])->latest();

        if ($request->has('status') && $request->status != 'Semua Status') {
            $query->where('status', strtolower($request->status));
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhere('id', 'like', "%{$search}%");
        }

        $bookings = $query->paginate(10);
        
        return view('manager.bookings', compact('bookings'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,paid'
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update(['status' => $request->status]);

        return back()->with('success', 'Status booking berhasil diperbarui.');
    }
    public function laporanPendapatan()
    {
        $bookings = Booking::whereIn('status', ['approved', 'paid'])
            ->orderBy('created_at', 'desc')
            ->get();

        $totalPendapatan = $bookings->sum('total_price');

        return view('manager.laporan.pendapatan', compact(
            'bookings',
            'totalPendapatan'
        ));
    }

public function laporanPendapatanPdf()
{
    $today = Carbon::today();

    $bookings = Booking::with(['user', 'field'])
        ->whereDate('created_at', $today)
        ->where('status', 'paid')
        ->orderBy('created_at', 'asc')
        ->get();

    $totalPendapatan = $bookings->sum('total_price');
    $tanggalCetak = $today->format('d-m-Y');

    $pdf = Pdf::loadView('manager.laporan.pendapatan-pdf', [
        'bookings' => $bookings,
        'totalPendapatan' => $totalPendapatan,
        'tanggalCetak' => $tanggalCetak,
    ]);

    return $pdf->download('laporan-pendapatan-hari-ini.pdf');
}

public function laporanPendapatanExcel()
{
    return Excel::download(
        new PendapatanHarianExport,
        'laporan-pendapatan-hari-ini.xlsx'
    );
}

}
