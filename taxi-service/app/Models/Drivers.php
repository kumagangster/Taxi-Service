<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
class Drivers extends Model implements Authenticatable
{
    use HasFactory;
    use HasFactory,Notifiable;
    use AuthenticatableTrait;
    protected $guard='driver';
    protected $fillable = [
        'driver_name',
        'driver_email',
        'password',
        'driver_phone',
        'live_location',
        'status'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'password' => 'hashed',
    ];
}
