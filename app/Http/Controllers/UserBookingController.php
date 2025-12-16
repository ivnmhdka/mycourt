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

    public function show($id)
    {
        $field = Field::findOrFail($id);
        
        // Fetch existing bookings for this field to show on calendar (simplified api or passed to view)
        // For now, we just pass the field details.
        // In a real scenario, you'd pass unavailable slots here.

        return view('user.booking', compact('field'));
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

        // Redirect to a success/payment page (Using dashboard for now as placeholder for payment)
        // ideally: return redirect()->route('booking.payment', $booking->id);
        return redirect()->route('dashboard')->with('success', 'Booking berhasil dibuat! Silakan lanjutkan pembayaran.');
    }
}
