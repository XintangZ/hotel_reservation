<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Room;
use App\Models\RoomType;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'check_in_date',
        'check_out_date',
        'number_of_guests',
        'number_of_nights',
        'total_price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function calculateNumberOfNights()
    {
        $checkIn = Carbon::parse($this->check_in_date);
        $checkOut = Carbon::parse($this->check_out_date);
        $this->number_of_nights = $checkOut->diffInDays($checkIn);
    }

    public function calculateTotalPrice()
    {
        $pricePerNight = Room::find($this->room_id)->roomType->price_per_night;
        $this->total_price = $pricePerNight * $this->number_of_nights;
    }

    protected static function booted()
    {
        static::saving(function ($reservation) {
            $reservation->calculateNumberOfNights();
            $reservation->calculateTotalPrice();
        });
    }
}
