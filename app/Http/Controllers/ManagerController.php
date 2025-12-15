<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;

class ManagerController extends Controller
{
    public function dashboard()
    {
        $today = Carbon::today();
        
        $pendingCount = Booking::where('status', 'pending')->count();
        $todayBookings = Booking::whereDate('start_time', $today)->count();
        $todayIncome = Booking::whereDate('created_at', $today)
                              ->where('status', '!=', 'rejected') // Assuming anything not rejected is potential income, or stricter: 'paid'/'approved'
                              ->sum('total_price');

        // Get 5 most recent bookings
        $recentBookings = Booking::with(['user', 'field'])->latest()->take(5)->get();

        return view('manager.dashboard', compact('pendingCount', 'todayBookings', 'todayIncome', 'recentBookings'));
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
}
