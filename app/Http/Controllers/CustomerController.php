<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCustomerRequest;
use App\Models\Customer;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CustomerController extends Controller
{
    public function create()
    {
        return Inertia::render('Customer/Form');
    }

    public function store(AddCustomerRequest $request)
    {
        Customer::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email_address' => $request->email_address,
            'budget' => $request->budget,
            'message' => $request->message,
        ]);

        return Redirect::route('customer.get')->with('success', 'Your request has been successfully submitted.');
    }

    public function profile(Customer $customer)
    {
        return Inertia::render('Customer/Profile', compact('customer'));
    }
}
