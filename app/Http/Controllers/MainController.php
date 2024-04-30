<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Http\Requests\RoomSearchRequest;
use App\Models\RoomType;
use Illuminate\Support\Carbon;

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

    public function search(RoomSearchRequest $request)
    {
        $params = $request->all();

        // Check if all required parameters are present
        if (!isset($params['check_in_date']) || !isset($params['check_out_date']) || !isset($params['number_of_guests'])) {
            $params['check_in_date'] = Carbon::now()->format('Y-m-d');
            $params['check_out_date'] = Carbon::now()->addDay(1)->format('Y-m-d');
            $params['number_of_guests'] = 1;
        } else {
            $request->validated();
        }

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

    public function defaultSearch()
    {
        $params = [
            'check_in_date' => Carbon::now()->format('Y-m-d'),
            'check_out_date' => Carbon::now()->addDay(1)->format('Y-m-d'),
            'number_of_guests' => 1,
        ];

        $roomTypes = RoomType::all();
        $availableRooms = [];
        foreach ($roomTypes as $roomType) {
            $rooms = $roomType->rooms()->get();
            foreach ($rooms as $key => $room) {
                if (!$room->isAvailable($params['check_in_date'], $params['check_out_date'])) {
                    unset($rooms[$key]);
                }
            }
            $availableRooms[$roomType->id] = $rooms;
        }
        $reminder = "Check your stay dates. These rooms are available for 1 night starting tonight.";
        
        return view('search-result', compact('params', 'availableRooms', 'reminder'));
    }
}
