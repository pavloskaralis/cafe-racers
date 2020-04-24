<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use JWTAuth;
use JWTFactory; 


class AuthController extends Controller
{
  
    public function jwt()
    {
        
        if ( !$token = JWTAuth::getToken() ) {
            $random = strval(rand(1000000,9999999));
            $payload = JWTFactory::sub($random)->make();
            $token = JWTAuth::encode($payload); 

            return [
                'jwt' => "{$token}",
                'id' => "{$random}"
            ];
        }

        $payload = JWTAuth::getPayload($token)->toArray();
        return ['id' => $payload["sub"]]; 
 
    }

}