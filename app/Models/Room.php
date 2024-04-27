<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RoomType;
use App\Models\Reservation;

class Room extends Model
{
    use HasFactory;

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function isAvailable($checkInDate, $checkOutDate = null) {
        $checkOutDate = $checkOutDate ?? $checkInDate;
        
        $isBooked = $this->reservations()->where('check_in_date', '<=', $checkOutDate)->where('check_out_date', '>=', $checkInDate);

        if ($isBooked->count() > 0) {
            return false;
        } else {
            return true;
        }
    }
}
