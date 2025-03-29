<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    public function showForm()
    {
        return view('booking-form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'required',
            'booking_date' => 'required|date',
            'booking_type' => 'required|string|max:255',
            'booking_slot' => 'required',
            'booking_time' => 'time',
            'message' => 'nullable|string',
        ]);

        Booking::create($request->all());

        return redirect()->back()->with('success', 'Booking successfully submitted!');
    }
}

?>