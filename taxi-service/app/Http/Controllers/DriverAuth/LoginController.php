<?php

namespace App\Http\Controllers\DriverAuth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Location\Facades\Location;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    public function showLoginForm()
    {
        return view('driver.auth.login');
    }
    public function customerLogin(Request $request){
        $credentials = $request->only('driver_email', 'password');

        if (Auth::guard('driver')->attempt($credentials)) {
            $authuser=Auth::guard('driver')->user();
            $position=Location::get();
            $authuser->status='active';
            $authuser->lat="";
            $authuser->lng="";
            $authuser->save();
            return redirect()->intended('/driver/home');
        }

        return redirect()->back()->withInput($request->only('driver_email'))->withErrors([
            'driver_email' => 'Invalid email or password',
        ]);
    }
    public function logout(Request $request)
    {
        $authuser=Auth::guard('driver')->user();
        if($authuser){
            $authuser->status='inactive';
            $authuser->save();
        }

        Auth::guard('driver')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }

    protected $redirectTo = RouteServiceProvider::DriverHome;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:driver')->except('logout');
    }
}
