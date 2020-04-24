<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('cors')->get('games', 'ApiController@getAllGames');
Route::middleware('cors')->get('games/{id}', 'ApiController@getGame');
Route::middleware('cors')->post('games', 'ApiController@createGame');
Route::middleware('cors')->put('games/{id}', 'ApiController@updateGame');
Route::middleware('cors')->delete('games/{id}', 'ApiController@deleteGame');

Route::middleware('cors')->get('jwt', 'AuthController@jwt');
