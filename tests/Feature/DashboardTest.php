<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

        // Create a user & authenticate to make request
        $user = User::factory()->create();

        $this->actingAs($user);
    }

    public function test_admin_can_view_dashboard_after_login()
    {
        $response = $this->get(route('dashboard'));

        $response->assertStatus(200);
    }
}
