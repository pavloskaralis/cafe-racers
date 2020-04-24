<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use JWTFactory; 
use JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class AuthController extends Controller
{
  
    public function jwt()
    {
        $random = strval(rand(1000000,9999999));
        $payload = JWTFactory::sub($random)->make();

        try {
            if ( !$token = JWTAuth::getToken() ) {
               
                $token = JWTAuth::encode($payload); 

                return [
                    'jwt' => "{$token}",
                    'id' => "{$random}"
                ];
            }

            $payload = JWTAuth::getPayload($token)->toArray();
            return ['id' => $payload["sub"]]; 

        } catch (TokenExpiredException $e) {
           
            $token = JWTAuth::encode($payload); 

            return [
                'jwt' => "{$token}",
                'id' => "{$random}"
            ];
        } catch (TokenInvalidException $e) {
            
            $token = JWTAuth::encode($payload); 

            return [
                'jwt' => "{$token}",
                'id' => "{$random}"
            ];
        }

    }

}