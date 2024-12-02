<?php

namespace App\Http\Controllers\DriverAuth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Drivers;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    protected $redirectTo = RouteServiceProvider::DriverHome;
    public function __construct()
    {
        $this->middleware('guest:driver');
    }
    public function showRegistrationForm()
    {
        return view('driver.auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'driver_name' => ['required', 'string', 'max:255'],
            'driver_email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'driver_phone' => ['required', 'numeric', 'digits:10', 'unique:customers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Drivers|\Illuminate\Http\RedirectResponse
     */
    protected function create(Request $request)
    {
       $driver=Drivers::create([
            'driver_name' => $request->driver_name,
            'driver_email' => $request->driver_email,
            'driver_phone' => $request->driver_phone,
            'password' => Hash::make($request->password),
        ]);
        if($driver)
            return redirect()->route('driver.login');
        else {
            return redirect()->route('driver.register');
        }
    }
}
