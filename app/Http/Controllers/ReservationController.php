<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use Illuminate\Support\Carbon;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  App\Http\Requests\ReservationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function create(ReservationRequest $request)
    {
        if ($request->all()) {
            $request->validated();
        }

        $checkInDate = $request->query('check_in_date', Carbon::today()->toDateString());
        $checkOutDate = $request->query('check_out_date', Carbon::tomorrow()->toDateString());
        $numberOfGuests = $request->query('number_of_guests', 1);
        $params=[
            'check_in_date' => $checkInDate,
            'check_out_date' => $checkOutDate,
            'number_of_guests' => $numberOfGuests,
        ];

        $availableRooms = Reservation::getAvailableRooms($checkInDate, $checkOutDate, $numberOfGuests);

        return view('reservation.create', compact('params', 'availableRooms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ReservationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $reservation = new Reservation($data);

        $reservation->save();
        return redirect('/dashboard')->with('successMsg', 'Reservation created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reservation = Reservation::find($id);
        return view('reservation.edit', compact('reservation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\ReservationRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReservationRequest $request, $id)
    {
        $reservation = Reservation::find($id);
        $reservation->fill($request->validated());

        $reservation->save();
        return redirect('/dashboard')->with('successMsg', 'Reservation updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservation = Reservation::find($id);

        $successMsg = 'Reservation canceled successfully!';
        if ($reservation->check_in_date < Carbon::now()->format('Y-m-d')) {
            $successMsg = 'Reservation deleted successfully!';
        }

        $reservation->delete();
        return redirect('/dashboard')->with('successMsg', $successMsg);
    }

    /**
     * Generate a reservation number.
     *
     * @return string
     */
    // private function generateReservationNumber()
    // {
    //     $uniqueIdentifier = uniqid('RES');
    //     $timestamp = time();

    //     return $uniqueIdentifier . $timestamp;
    // }
}
