<?php

namespace App\Repositories\Customers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerRepository
{
    public function getCustomers()
    {
        return Customer::paginate(10);
    }

    public function updateWordpressUserId(Request $request, $wpUserId)
    {
        $contact = Customer::find($request->id);

        $contact->wp_user_id = $wpUserId;

        $contact->save();
    }

    public function findCustomerById($id)
    {
        return Customer::find($id);
    }
}