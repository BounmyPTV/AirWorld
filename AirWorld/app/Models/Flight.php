<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $fillable = ['departure_date','arrival_date','departure_time','arrival_time',
        'departure_airport_id','arrival_airport_id','airplane_id','price'];
    
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
