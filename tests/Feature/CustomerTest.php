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
}
