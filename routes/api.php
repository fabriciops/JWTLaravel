<?php

use App\Http\Controllers\AuthController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/404','AuthController@unauthotized');

Route::get('/ping','AuthController@pong');

// Route::get('/ping', function () {
//     return ('pong');
// });

Route::post('/auth/login', 'AuthController@login');
Route::post('/auth/register', 'AuthController@register');

Route::get('/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
});

Route::middleware('auth:api')->group(function(){
    Route::post('/auth/validate', 'AuthController@validateToken');
    Route::post('/auth/logout', 'AuthController@logout');
});