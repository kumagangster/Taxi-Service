<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Drivers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DriverController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:driver');
    }

    public function edit($id)
    {
        $driver=Drivers::find($id)->first();
        return view('driver.edit', compact('driver'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'driver_name' => 'required|string|max:255',
            'driver_email' => 'required|email|max:255',
            'driver_phone' => 'required|numeric|digits:10',
            'password' => 'nullable|string|min:8',
        ]);
        $driver = Drivers::findOrFail($id);
        $driver->update([
            'driver_name' => $request->input('driver_name'),
            'driver_email' => $request->input('driver_email'),
            'driver_phone' => $request->input('driver_phone'),
            'password' => Hash::make($request->input('password')),
        ]);
        return redirect()->route('driver.home', ['id' => $id])->with('success', 'Driver updated successfully');
    }
}
