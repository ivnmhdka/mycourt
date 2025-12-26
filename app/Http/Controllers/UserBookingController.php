<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Field;
use App\Models\Booking;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserBookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Field::query();

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        $fields = $query->get();

        return view('user.fields', compact('fields'));
    }

    public function show(Request $request, $id)
    {
        // 1. Fetch Field
        $field = Field::findOrFail($id);
        
        // 2. Tentukan Tanggal (Default hari ini atau dari request)
        $date = $request->input('date', date('Y-m-d'));

        // 3. Ambil data Booking status (Approved/Pending/Paid) -> Merah
        $bookings = Booking::where('field_id', $id)
            ->whereDate('start_time', $date)
            ->where('status', '!=', 'rejected')
            ->get();

        // 4. Ambil data Schedule status (Blocked) -> Merah
        $schedules = Schedule::where('field_id', $id)
            ->whereDate('date', $date)
            ->where('is_available', false)
            ->get();

        // 5. Merge keduanya menjadi satu array 'unavailableSlots'
        $unavailableSlots = [];

        foreach ($bookings as $booking) {
            $start = Carbon::parse($booking->start_time);
            $end = Carbon::parse($booking->end_time);
            while ($start < $end) {
                $unavailableSlots[] = $start->format('H:i');
                $start->addHour();
            }
        }

        foreach ($schedules as $schedule) {
            $start = Carbon::parse($schedule->start_time);
            $end = Carbon::parse($schedule->end_time);
            while ($start < $end) {
                // Hindari duplikat jika manager memblokir jadwal yang sudah ada booking (edge case)
                if (!in_array($start->format('H:i'), $unavailableSlots)) {
                    $unavailableSlots[] = $start->format('H:i');
                }
                $start->addHour();
            }
        }

        // Kirim data ke view
        return view('user.booking', compact('field', 'date', 'unavailableSlots'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'field_id' => 'required|exists:fields,id',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i', // e.g., 08:00
            'duration' => 'required|integer|min:1', // hours
        ]);

        $startDateTime = Carbon::createFromFormat('Y-m-d H:i', $request->date . ' ' . $request->start_time);
        $endDateTime = $startDateTime->copy()->addHours($request->duration);

        // --- 1. Check Existing Bookings (Double Booking) ---
        $conflictingBooking = Booking::where('field_id', $request->field_id)
            ->where('status', '!=', 'rejected') 
            ->where(function ($query) use ($startDateTime, $endDateTime) {
                $query->where('start_time', '<', $endDateTime)
                      ->where('end_time', '>', $startDateTime);
            })
            ->exists();

        if ($conflictingBooking) {
            return back()->with('error', 'Jadwal yang dipilih sudah terisi booking lain.')->withInput();
        }

        // --- 2. Check Blocked Schedules (Maintenance) ---
        // Logic Overlap sama: StartBlock < EndRequest && EndBlock > StartRequest
        $blockedSchedule = Schedule::where('field_id', $request->field_id)
            ->whereDate('date', $request->date)
            ->where('is_available', false)
            ->where(function($query) use ($request, $endDateTime) {
                $reqStart = $request->start_time; 
                $reqEnd = $endDateTime->format('H:i'); 
                
                $query->where('start_time', '<', $reqEnd)
                      ->where('end_time', '>', $reqStart);
            })
            ->exists();

        if ($blockedSchedule) {
            return back()->with('error', 'Jadwal tidak tersedia (Sedang Maintenance/Ditutup Pengelola).')->withInput();
        }

        // Calculate Price
        $field = Field::find($request->field_id);
        $totalPrice = $field->price_per_hour * $request->duration;

        // Create Booking
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'field_id' => $request->field_id,
            'start_time' => $startDateTime,
            'end_time' => $endDateTime,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        return redirect()->route('booking.payment', $booking->id);
    }
    
    public function payment($id)
    {
        $booking = Booking::with('field')->findOrFail($id);
        
        if ($booking->status !== 'pending') {
             return redirect()->route('dashboard')->with('error', 'Booking tidak dalam status pending.');
        }

        return view('user.payment', compact('booking'));
    }

    public function confirmPayment($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->status !== 'pending') {
             return redirect()->route('dashboard')->with('error', 'Booking tidak valid untuk pembayaran.');
        }

        $booking->update([
            'status' => 'paid' 
        ]);

        return redirect()->route('booking.success', $booking->id);
    }

    public function success($id)
    {
        $booking = Booking::findOrFail($id);
        return view('user.success', compact('booking'));
    }
}
