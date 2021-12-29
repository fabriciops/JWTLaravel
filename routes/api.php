<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BilletController;
use App\Http\Controllers\DocController;
use App\Http\Controllers\FoundAndLostController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WallController;
use App\Http\Controllers\WarningController;
use App\Models\Reservations;
use Egulias\EmailValidator\Warning\Warning;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/404', [AuthController::class, 'unauthotized'])->name('login');

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);

Route::middleware('auth:api')->group(function(){
    Route::post('/auth/validate', [AuthController::class, 'validateToken']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // Mural
    Route::get('/walls', [AuthController::class, 'getAll']);
    Route::post('/walls/{id}/like', [AuthController::class, 'like']);

    // Documentos
    Route::get('/docs', [DocController::class, 'getAll']);

    // LIvro de ocorrências
    Route::get('/warnings', [WarningController::class, 'getMyWarnings']);
    Route::post('/warning', [WarningController::class, 'setWarning']);
    Route::post('/warning/file', [WarningController::class, 'addwarningFile']);

    // Boletos
    Route::get('/billets', [BilletController::class, 'getAll']);

    // Achados e perdidos
    Route::get('/foundandlost',[FoundAndLostController::class, 'getAll']);
    Route::post('/foundandlost',[FoundAndLostController::class, 'insert']);
    Route::put('/foundandlost/{id}',[FoundAndLostController::class, 'getAll']);

    // Unidades
    Route::get('/unit/{id}',[UnitController::class, 'getInfo']);
    Route::get('/unit/{id}/addperson',[UnitController::class, 'addPerson']);
    Route::get('/unit/{id}/addvehicle',[UnitController::class, 'addVehicle']);
    Route::get('/unit/{id}/addpet',[UnitController::class, 'addPet']);
    Route::get('/unit/{id}/removeperson',[UnitController::class, 'removePerson']);
    Route::get('/unit/{id}/removevehicle',[UnitController::class, 'removevehicle']);
    Route::get('/unit/{id}/removepet',[UnitController::class, 'removePet']);

    // Reservas
    Route::get('/reservation', [ReservationController::class, 'getReservations']);
    Route::post('/reservation/{id}', [ReservationController::class, 'setReservation']);

    Route::get('/reservation/{id}/disableddates', [ReservationController::class, 'getDisableddates']);
    Route::get('/reservation/{id}/times', [ReservationController::class, 'getTimes']);

    Route::get('/myreservation', [ReservationController::class, 'getMyReservation']);
    Route::delete('/myreservation/{id}', [ReservationController::class, 'delMyReservation']);
    

});
