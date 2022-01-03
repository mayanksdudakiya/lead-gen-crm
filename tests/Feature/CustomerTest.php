<?php

namespace Tests\Feature;

use App\Models\Customer;
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

    public function test_name_parameter_is_required()
    {
        $response = $this->post(route('customer.store'), [
            //'name' => 'John Doe 1',
            'phone_number' => '0123456789',
            'email_address' => 'john.doe.1@gmail.com',
            'budget' => 45675,
            'message' => 'This is the test message',
        ]);

        $response->assertSessionHasErrors(['name']);

        $this->assertEquals(0, Customer::where('email_address', 'john.doe.1@gmail.com')->count());
    }

    public function test_phone_number_parameter_is_required()
    {
        $response = $this->post(route('customer.store'), [
            'name' => 'John Doe 2',
            //'phone_number' => '0123456789',
            'email_address' => 'john.doe.2@gmail.com',
            'budget' => 45675,
            'message' => 'This is the test message',
        ]);

        $response->assertSessionHasErrors(['phone_number']);

        $this->assertEquals(0, Customer::where('email_address', 'john.doe.2@gmail.com')->count());
    }

    public function test_email_address_parameter_is_required()
    {
        $response = $this->post(route('customer.store'), [
            'name' => 'John Doe 3',
            'phone_number' => '0123456789',
            //'email_address' => 'john.doe.3@gmail.com',
            'budget' => 45675,
            'message' => 'This is the test message',
        ]);

        $response->assertSessionHasErrors(['email_address']);

        $this->assertEquals(0, Customer::where('name', 'John Doe 3')->count());
    }

    public function test_invalid_email_address()
    {
        $response = $this->post(route('customer.store'), [
            'name' => 'John Doe 4',
            'phone_number' => '0123456789',
            'email_address' => 'john.doe.4', // Invalid email address
            'budget' => 45675,
            'message' => 'This is the test message',
        ]);

        $response->assertSessionHasErrors(['email_address']);

        $this->assertEquals(0, Customer::where('name', 'John Doe 4')->count());
    }

    public function test_budget_parameter_is_required()
    {
        $response = $this->post(route('customer.store'), [
            'name' => 'John Doe 5',
            'phone_number' => '0123456789',
            'email_address' => 'john.doe.5@gmail.com',
            //'budget' => 45675,
            'message' => 'This is the test message',
        ]);

        $response->assertSessionHasErrors(['budget']);

        $this->assertEquals(0, Customer::where('name', 'John Doe 5')->count());
    }

    public function test_invalid_budget_parameter()
    {
        $response = $this->post(route('customer.store'), [
            'name' => 'John Doe 6',
            'phone_number' => '0123456789',
            'email_address' => 'john.doe.6@gmail.com',
            'budget' => -45675, // Negative value checking
            'message' => 'This is the test message',
        ]);

        $response->assertSessionHasErrors(['budget']);

        $this->assertEquals(0, Customer::where('name', 'John Doe 6')->count());
    }

    public function test_message_parameter_is_required()
    {
        $response = $this->post(route('customer.store'), [
            'name' => 'John Doe 7',
            'phone_number' => '0123456789',
            'email_address' => 'john.doe.7@gmail.com',
            'budget' => 45675,
            //'message' => 'This is the test message',
        ]);

        $response->assertSessionHasErrors(['message']);

        $this->assertEquals(0, Customer::where('name', 'John Doe 7')->count());
    }

    public function test_duplicate_customer_can_not_be_created()
    {
        $response = $this->post(route('customer.store'), [
            'name' => 'John Doe 8',
            'phone_number' => '0123456789',
            'email_address' => 'john.doe@gmail.com', // Same email as first
            'budget' => 45675,
            'message' => 'This is the test message',
        ]);

        $response->assertSessionHasErrors(['email_address']);

        $this->assertEquals(0, Customer::where('name', 'John Doe 8')->count());
    }
}
