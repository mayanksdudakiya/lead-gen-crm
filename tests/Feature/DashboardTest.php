<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed([
            UserSeeder::class,
        ]);

        // Create a user & authenticate to make request
        $user = User::factory()->create();

        $this->actingAs($user);
    }

    public function test_admin_can_view_dashboard_after_login()
    {
        $response = $this->get(route('dashboard'));

        $response->assertStatus(200);
    }

    public function test_admin_can_view_customer_profile()
    {
        $customer = Customer::factory()->create();

        $response = $this->get(route('customer.show', $customer->id));

        $response->assertStatus(200);
    }
}
