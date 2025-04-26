<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    protected $fillable = ['firstname','surname','seat_number','reservation_id','adult'];
    public function reservation() {
        return $this->belongsTo(Reservation::class);
    }
}
