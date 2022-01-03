<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class WordpressUserCreationTest extends TestCase
{
    use RefreshDatabase;

    public $siteUrl;

    public function setUp(): void
    {
        parent::setUp();

        $this->siteUrl = getenv('SITE_URL');

        $this->seed([
            UserSeeder::class,
        ]);

        // Create a user & authenticate to make request
        $user = User::factory()->create();

        $this->actingAs($user);
    }
    
    /**
     * Make a fake request to determine submission of parameters
     */
    public function test_wordpress_user_can_be_created()
    {
        Http::fake();

        Http::post("{$this->siteUrl}/wp-json/el/v1/user", [
            'name' => 'John Doe',
            'phone_number' => '0123456789',
            'email_address' => 'test@example.com',
            'budget' => 45675,
            'message' => 'This is the test message',
        ]);

        Http::assertSent(function (Request $request) {
            return $request->url() == "{$this->siteUrl}/wp-json/el/v1/user" &&
                   $request['name'] == 'John Doe' &&
                   $request['message'] == 'This is the test message';
        });
    }
}
