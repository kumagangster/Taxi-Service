<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Ride;
use Illuminate\Http\Request;

class RideController extends Controller
{
    public function index(){
        $fares=Ride::where('status','=','pending')->get();
        return view('Booking.requestview',['fares'=>$fares]);
    }
    public function accept($id){

    }
}
