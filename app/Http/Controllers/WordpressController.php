<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WordpressController extends Controller
{
    public function createUser(Request $request)
    {
        $siteUrl = env('SITE_URL');
		
        $request->request->add([
            'username' => env( 'SITE_USERNAME' ),
            'password' => env( 'SITE_PASSWORD' )
        ]);

        $response = Http::post("{$siteUrl}/wp-json/el/v1/user", $request->all());

        return $response->body(); 
    }
}
