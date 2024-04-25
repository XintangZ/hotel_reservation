<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reservation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'check_in_date' => 'required',
            'check_out_date' => 'required',
            'room_type' => 'required',
            'number_of_guests' => 'required',
        ]);

        $reservation = Reservation::create([
            'user_id' => $request->user_id,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'room_type' => $request->room_type,
            'number_of_guests' => $request->number_of_guests,
        ]);

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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'check_in_date' => 'required',
            'check_out_date' => 'required',
            'room_type' => 'required',
            'number_of_guests' => 'required',
        ]);

        $reservation = Reservation::find($id);
        $reservation->fill($request->all());

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
        Reservation::find($id)->delete();
        return redirect('/dashboard')->with('successMsg', 'Reservation deleted successfully!');
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
