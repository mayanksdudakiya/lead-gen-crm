<?php

namespace App\Http\Controllers;

use App\Repositories\Customers\CustomerRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(CustomerRepository $repo)
    {
        return Inertia::render('Dashboard', [
            'customers' => $repo->getCustomers()
        ]);
    }
}
