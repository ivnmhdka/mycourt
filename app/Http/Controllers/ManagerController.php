<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Schedule;
use App\Models\Field;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PendapatanHarianExport;
use Maatwebsite\Excel\Facades\Excel;


class ManagerController extends Controller
{
    public function dashboard()
    {
        $today = Carbon::today();



        // Booking hari ini (Volume booking masuk hari ini, excluding rejected)
        $todayBookings = Booking::whereDate('created_at', today())
            ->where('status', '!=', 'rejected')
            ->count();


        // 🔥 PENDAPATAN HARI INI (INI INTINYA)
        // Fix: Use 'approved' as the standard for PAID bookings.
        // Also include 'paid' for backward compatibility if any data remains.
        $todayIncome = Booking::whereDate('created_at', $today)
            ->whereIn('status', ['approved', 'paid'])
            ->sum('total_price');

        // Booking terbaru
        $recentBookings = Booking::with(['user', 'field'])
            ->latest()
            ->take(5)
            ->get();

        return view('manager.dashboard', compact(
            'todayBookings',
            'todayIncome',
            'recentBookings'
        ));
    }

    public function index(Request $request)
    {
        $query = Booking::with(['user', 'field'])->latest();

        if ($request->has('status') && $request->status != 'Semua Status') {
            // Map "Paid" filter to include Approved effectively if needed, but let's keep strict for now
            // Or better, let the view filter simplify.
            $query->where('status', strtolower($request->status));
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
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
        // Fix: Include 'approved'
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

        // Fix: Include 'approved'
        $bookings = Booking::with(['user', 'field'])
            ->whereDate('created_at', $today)
            ->whereIn('status', ['approved', 'paid'])
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

    public function schedule(Request $request)
    {
        $date = $request->input('date', date('Y-m-d'));
        $fieldId = $request->input('field_id', 1);

        $fields = Field::all();

        // 2. Ambil Bookings di tanggal tersebut (untuk warna Merah)
        $bookings = Booking::where('field_id', $fieldId)
            ->whereDate('start_time', $date)
            ->where('status', '!=', 'rejected')
            ->get();

        // 3. Ambil Blocked Slots (Schedules) di tanggal tersebut (untuk warna Abu-abu)
        $schedules = Schedule::where('field_id', $fieldId)
            ->whereDate('date', $date)
            ->where('is_available', false)
            ->get();

        // Format data
        $bookedSlots = [];
        foreach ($bookings as $booking) {
            $start = Carbon::parse($booking->start_time);
            $end = Carbon::parse($booking->end_time);

            while ($start < $end) {
                // Key by time string 'H:i'
                // Value is the booking object or specific details needed
                $timeKey = $start->format('H:i');
                $bookedSlots[$timeKey] = [
                    'id' => $booking->id,
                    'user_name' => $booking->user->name ?? 'User Terhapus',
                    'start_time' => $booking->start_time, // useful for checking match
                    'original_booking' => $booking
                ];
                $start->addHour();
            }
        }

        $blockedSlots = [];
        foreach ($schedules as $schedule) {
            $start = Carbon::parse($schedule->start_time);
            $end = Carbon::parse($schedule->end_time);

            while ($start < $end) {
                $blockedSlots[] = $start->format('H:i');
                $start->addHour();
            }
        }

        return view('manager.schedule', compact('fields', 'date', 'fieldId', 'bookedSlots', 'blockedSlots'));
    }

    public function updateSchedule(Request $request)
    {
        $request->validate([
            'field_id' => 'required|exists:fields,id',
            'date' => 'required|date',
            'blocked_slots' => 'nullable|array',
            'cancelled_bookings' => 'nullable|array' // New input for cancelling bookings
        ]);

        $fieldId = $request->field_id;
        $date = $request->date;
        $newBlockedSlots = $request->input('blocked_slots', []);
        $cancelledBookings = $request->input('cancelled_bookings', []);

        // 1. Process Booking Cancellations first
        if (!empty($cancelledBookings)) {
            // Find bookings that overlap with these times on this date and field
            foreach ($cancelledBookings as $time) {
                // Find and reject/delete bookings starting at this time
                // Or covering this time.
                // Simple approach: find bookings where start_time matches
                $startDateTime = Carbon::createFromFormat('Y-m-d H:i', $date . ' ' . $time);

                Booking::where('field_id', $fieldId)
                    ->where('status', '!=', 'rejected')
                    ->where(function ($q) use ($startDateTime) {
                        // Check if this specific hour is covered by a booking
                        // The cancelled_bookings array sends specific hours (08:00).
                        // If a booking is 08:00-10:00, sending 08:00 should cancel it.
                        // If sending 09:00, should it cancel the whole booking? Yes probably.
                        $q->where('start_time', '<=', $startDateTime)
                            ->where('end_time', '>', $startDateTime);
                    })
                    ->update(['status' => 'rejected']);
            }
        }

        // 2. Reset and Update Blocked Schedules
        Schedule::where('field_id', $fieldId)
            ->whereDate('date', $date)
            ->where('is_available', false)
            ->delete();

        foreach ($newBlockedSlots as $time) {
            Schedule::create([
                'field_id' => $fieldId,
                'date' => $date,
                'start_time' => $time,
                'end_time' => Carbon::parse($time)->addHour()->format('H:i'),
                'is_available' => false,
                'remarks' => 'Manual Block by Manager'
            ]);
        }


        return redirect()->route('manager.schedule', ['date' => $date, 'field_id' => $fieldId])
            ->with('success', 'Jadwal berhasil diperbarui.');
    }
}
