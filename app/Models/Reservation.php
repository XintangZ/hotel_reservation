<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use App\Models\User;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'check_in_date',
        'check_out_date',
        'room_type',
        'number_of_guests',
        'number_of_nights',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function calculateNumberOfNights()
    {
        $checkIn = Carbon::parse($this->check_in_date);
        $checkOut = Carbon::parse($this->check_out_date);
        $this->number_of_nights = $checkOut->diffInDays($checkIn);
    }

    protected static function booted()
    {
        static::saving(function ($reservation) {
            $reservation->calculateNumberOfNights();
        });
    }
}
