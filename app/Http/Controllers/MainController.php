<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Http\Requests\RoomSearchRequest;
use App\Models\RoomType;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $weather = $request->get('weather');
        return view('home', compact('weather'));
    }

    /**
     * Display the specified resources.
     * 
     * @param  App\Http\Requests\RoomSearchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function search(RoomSearchRequest $request)
    {
        $request->validated();
        $params = $request->all();
        $reservationToEdit = isset($params['reservation_id']) ? Reservation::find($params['reservation_id']) : null;

        $suitableRoomTypes = RoomType::where('capacity', '>=', $params['number_of_guests'])->get();

        $availableRooms = [];
        foreach ($suitableRoomTypes as $roomType) {
            $rooms = $roomType->rooms()->get();
            foreach ($rooms as $key => $room) {
                if (!$room->isAvailable($params['check_in_date'], $params['check_out_date'], $reservationToEdit)) {
                    unset($rooms[$key]);
                }
            }
            $availableRooms[$roomType->id] = $rooms;
        }

        return view('search-result', compact('params', 'availableRooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
