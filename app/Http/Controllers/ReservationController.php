<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReservationRequest;
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
