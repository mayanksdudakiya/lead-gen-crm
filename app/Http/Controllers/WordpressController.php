<?php

namespace App\Http\Controllers;

use App\Repositories\Customers\CustomerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WordpressController extends Controller
{
    public function createUser(Request $request, CustomerRepository $repo)
    {
        $siteUrl = env('SITE_URL');
		
        // These data can be validated through seperate request   
        $request->request->add([
            'username' => env( 'SITE_USERNAME' ),
            'password' => env( 'SITE_PASSWORD' )
        ]);

        $response = Http::post("{$siteUrl}/wp-json/el/v1/user", $request->all());

         // Update wordpress user id in the database on success
         $responseData = json_decode($response->body());
         if ( !empty($responseData->data) && !empty($responseData->data->wp_user_id) ) :
             $wpUserId = $responseData->data->wp_user_id;
         
             $repo->updateWordpressUserId($request, $wpUserId);
         endif;

        return $response->body(); 
    }
}
