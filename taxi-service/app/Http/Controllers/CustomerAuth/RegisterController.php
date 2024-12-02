<?php

namespace App\Http\Controllers\CustomerAuth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
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
    protected $redirectTo = RouteServiceProvider::CustomerHome;
    public function __construct()
    {
        $this->middleware('guest:customer');
    }
    public function showRegistrationForm()
    {
        return view('Customer.auth.register');
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
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'customer_phone' => ['required', 'numeric', 'digits:10', 'unique:customers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Customer|\Illuminate\Http\RedirectResponse
     */
    protected function create(Request $request)
    {
       $customer=Customer::create([
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'password' => Hash::make($request->password),
        ]);
        if($customer)
            return redirect()->route('customer.login');
        else {
            return redirect()->route('customer.register');
        }
    }
}
