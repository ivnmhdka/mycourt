<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Field;
use App\Models\Booking;
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
    $field = Field::findOrFail($id);
    
    // Ambil tanggal dari input, jika tidak ada pakai hari ini (2025-12-27)
    // Untuk tes dengan data Anda, Anda bisa sementara ganti ke '2025-12-26'
    $date = $request->input('date', Carbon::today()->toDateString());

    $bookings = Booking::where('field_id', $id)
        ->whereDate('start_time', $date)
        ->whereIn('status', ['pending', 'paid'])
        ->get();

    $bookedSlots = [];

    foreach ($bookings as $booking) {
        $start = Carbon::parse($booking->start_time);
        $end = Carbon::parse($booking->end_time);

        // Tambahkan semua jam di antara start dan end ke dalam array
        while ($start < $end) {
            $bookedSlots[] = $start->format('H:i');
            $start->addHour();
        }
    }

    return view('user.booking', compact('field', 'bookedSlots', 'date'));
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

        // Check for Double Booking
        // Overlap Logic: (StartA < EndB) and (EndA > StartB)
        $conflictingBooking = Booking::where('field_id', $request->field_id)
            ->where('status', '!=', 'rejected') // Ignore rejected bookings
            ->where(function ($query) use ($startDateTime, $endDateTime) {
                $query->where('start_time', '<', $endDateTime)
                      ->where('end_time', '>', $startDateTime);
            })
            ->exists();

        if ($conflictingBooking) {
            return back()->withErrors(['time_slot' => 'Jadwal yang dipilih sudah terisi. Silakan pilih waktu lain.'])->withInput();
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

        // Redirect to a success/payment page
        return redirect()->route('booking.payment', $booking->id);
    }

    public function payment($id)
    {
        $booking = Booking::with('field')->findOrFail($id);
        
        // Prevent accessing payment page if already paid or cancelled, etc if needed.
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

        // Update status
        $booking->update([
            'status' => 'paid' // Or 'paid' depending on your logic, using 'confirmed' as simple flow
        ]);

        return redirect()->route('booking.success', $booking->id);
    }

    public function success($id)
    {
        $booking = Booking::findOrFail($id);
        return view('user.success', compact('booking'));
    }
}
