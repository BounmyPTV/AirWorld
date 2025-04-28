<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['flight_id','user_id','baggages','paid'];
    public function passengers() {
        return $this->hasMany(Passenger::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function flight() {
        return $this->belongsTo(Flight::class);
    }
}
