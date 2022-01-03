<?php

namespace App\Repositories\Customers;

use App\Models\Customer;

class CustomerRepository
{
    public function getCustomers()
    {
        return Customer::paginate(10);
    }
}