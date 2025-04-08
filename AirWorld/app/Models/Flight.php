<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    public function reservations() {
        return $this->hasMany(Reservation::class);
    }

    public function departureAirport() {
        return $this->belongsTo(Airport::class, 'departure_airport_id');
    }

    public function arrivalAirport() {
        return $this->belongsTo(Airport::class, 'arrival_airport_id');
    }

    public function airplane() {
        return $this->belongsTo(Airplane::class);
    }
}
