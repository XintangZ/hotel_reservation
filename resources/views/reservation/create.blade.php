<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('reservation.store') }}" method="POST">
        @csrf

        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name">

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name">
        <br>
        <br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email">
        <br>
        <br>

        <label for="phone_number">Phone Number:</label>
        <input type="tel" name="phone_number" id="phone_number">
        <br>
        <br>

        <label for="check_in_date">Check-in Date:</label>
        <input type="date" name="check_in_date" id="check_in_date">
        <br>
        <br>

        <label for="check_out_date">Check-out Date:</label>
        <input type="date" name="check_out_date" id="check_out_date" >
        <br>
        <br>

        <label for="room_type">Room Type:</label>
        <select name="room_type" id="room_type">
            <option value="single">Single</option>
            <option value="double">Double</option>
            <option value="triple">Triple</option>
        </select>
        <br>
        <br>

        <label for="number_of_guests">Number of Guests:</label>
        <input type="number" name="number_of_guests" id="number_of_guests">
        <br>
        <br>

        <button>Submit</button>
    </form>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif
</body>
</html>