<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:customer');
    }

    public function edit($id)
    {
        $customer=Customer::find($id)->first();
        return view('Customer.edit', compact('customer'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|numeric|digits:10',
        ]);
        $customer = Customer::findOrFail($id);
        $customer->update([
            'customer_name' => $request->input('customer_name'),
            'customer_email' => $request->input('customer_email'),
            'customer_phone' => $request->input('customer_phone'),
        ]);
        return redirect()->route('customer.home', ['id' => $id])->with('success', 'Customer updated successfully');
    }
}
