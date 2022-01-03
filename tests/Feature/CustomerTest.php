<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerTest extends TestCase
{   
    use RefreshDatabase;

    public function test_customer_form_screen_can_be_rendered()
    {
        $response = $this->get(route('customer.get'));

        $response->assertStatus(200);
    }

    public function test_customer_can_created()
    {
        $response = $this->post(route('customer.store'), [
            'name' => 'John Doe',
            'phone_number' => '0123456789',
            'email_address' => 'john.doe@gmail.com',
            'budget' => 45675,
            'message' => 'This is the test message',
        ]);

        $response->assertRedirect(route('customer.get'));

        $this->assertDatabaseCount('customers', 1);
    }
}
