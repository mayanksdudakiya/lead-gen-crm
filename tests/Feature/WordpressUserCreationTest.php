<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Testing\Fluent\AssertableJson;
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

    /**
     * Make a real request to test the parameter validation
     * as we have no rate limiter
     */
    public function test_a_name_is_required_parameter()
    {
        $response = $this->post(route('create.wordpress.user'), [
            //'name' => 'John Doe',
            'phone_number' => '0123456789',
            'email_address' => 'test@example.com',
            'budget' => 45675,
            'message' => 'This is the test message',
        ]);

        $response->assertJson(fn (AssertableJson $json) =>
            $json->where('code', 'rest_missing_callback_param')
                 ->where('message', 'Missing parameter(s): name')
                 ->etc()
        );
    }

    public function test_a_phone_number_is_required_parameter()
    {
        $response = $this->post(route('create.wordpress.user'), [
            'name' => 'John Doe',
            //'phone_number' => '0123456789',
            'email_address' => 'test@example.com',
            'budget' => 45675,
            'message' => 'This is the test message',
        ]);

        $response->assertJson(fn (AssertableJson $json) =>
            $json->where('code', 'rest_missing_callback_param')
                 ->where('message', 'Missing parameter(s): phone_number')
                 ->etc()
        );
    }

    public function test_a_email_address_is_required_parameter()
    {
        $response = $this->post(route('create.wordpress.user'), [
            'name' => 'John Doe',
            'phone_number' => '0123456789',
            //'email_address' => 'test@example.com',
            'budget' => 45675,
            'message' => 'This is the test message',
        ]);

        $response->assertJson(fn (AssertableJson $json) =>
            $json->where('code', 'rest_missing_callback_param')
                 ->where('message', 'Missing parameter(s): email_address')
                 ->etc()
        );
    }

    public function test_invalid_email_address()
    {
        $response = $this->post(route('create.wordpress.user'), [
            'name' => 'John Doe',
            'phone_number' => '0123456789',
            'email_address' => 'john.doe',
            'budget' => 45675,
            'message' => 'This is the test message',
        ]);

        $response->assertJson(fn (AssertableJson $json) =>
            $json->where('code', 'rest_invalid_param')
                 ->where('message', 'Invalid parameter(s): email_address')
                 ->etc()
        );
    }

    public function test_a_budget_is_required_parameter()
    {
        $response = $this->post(route('create.wordpress.user'), [
            'name' => 'John Doe',
            'phone_number' => '0123456789',
            'email_address' => 'test@example.com',
            //'budget' => 45675,
            'message' => 'This is the test message',
        ]);

        $response->assertJson(fn (AssertableJson $json) =>
            $json->where('code', 'rest_missing_callback_param')
                 ->where('message', 'Missing parameter(s): budget')
                 ->etc()
        );
    }

    public function test_invalid_budget_parameter()
    {
        $response = $this->post(route('create.wordpress.user'), [
            'name' => 'John Doe',
            'phone_number' => '0123456789',
            'email_address' => 'john.doe@gmail.com',
            'budget' => -45675,
            'message' => 'This is the test message',
        ]);

        $response->assertJson(fn (AssertableJson $json) =>
            $json->where('code', 'rest_invalid_param')
                 ->where('message', 'Invalid parameter(s): budget')
                 ->etc()
        );
    }

    public function test_a_message_is_required_parameter()
    {
        $response = $this->post(route('create.wordpress.user'), [
            'name' => 'John Doe',
            'phone_number' => '0123456789',
            'email_address' => 'test@example.com',
            'budget' => 45675,
            //'message' => 'This is the test message',
        ]);

        $response->assertJson(fn (AssertableJson $json) =>
            $json->where('code', 'rest_missing_callback_param')
                 ->where('message', 'Missing parameter(s): message')
                 ->etc()
        );
    }

    /*public function test_duplicate_user_creation()
    {
        $response = $this->post(route('create.wordpress.user'), [
            'name' => 'John Doe',
            'phone_number' => '0123456789',
            'email_address' => 'admin@gmail.com', // Should be existing email in WP
            'budget' => 45675,
            'message' => 'This is the test message',
        ]);

        $response->assertJson(fn (AssertableJson $json) =>
            $json->where('code', 'rest_user_already_exists')
                 ->where('message', 'Sorry, This user has already been registered')
                 ->etc()
        );
    }*/
}
