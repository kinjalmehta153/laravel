<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
</head>
<body>
    <h2>Booking Form</h2>
     <h2>Welcome, {{ Auth::user()->first_name }}!</h2>
    <a href="{{ route('logout') }}">Logout</a>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('booking.store') }}" method="POST">
        @csrf
        <label>Customer Name:</label>
        <input type="text" name="name" required>
        <br>

        <label>Customer Email:</label>
        <input type="email" name="email" required>
        <br>

        <label>Customer Phone:</label>
        <input type="text" name="phone" required>
        <br>

        <label>Booking Date:</label>
        <input type="date" name="booking_date" required>
        <br>

        <label>Booking Type:</label>
        <select name="booking_type" required>
            <option value="full_day">Full Day</option>
            <option value="half_day">Half Day</option>
            <option value="custom">Custom</option>
        </select>
        <br>

        <label>Booking Slot:</label>
        <select name="booking_slot" required>
            <option value="fist_half">First Half</option>
            <option value="second_half">Second Half</option>
        </select>
        <br>

         <label>Booking Time:</label>
         <input type="time" name="booking_time" required>
        <br>

        <label>Message:</label>
        <textarea name="message"></textarea>
        <br>

        <button type="submit">Submit Booking</button>
    </form>
</body>
</html>
