<?php

namespace App\Http\Controllers\DriverAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:driver');
    }
    public function index()
    {
        return view('driver.driverhome');
    }
}
