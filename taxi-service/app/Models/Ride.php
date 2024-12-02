<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_latitude',
        'start_longitude',
        'destination_longitude',
        'destination_latitude',
        'start_location',
        'destination_location',
        'requested_time',
        'status',
        'driver_id',
    ];
}
