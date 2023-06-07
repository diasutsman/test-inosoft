<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\MotorController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleSalesController;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);

    // Vehicles
    Route::apiResource('vehicles', VehicleController::class)->except('destroy');

    // Cars
    Route::get('cars/report', [CarController::class, 'report']);
    Route::put('cars/{id}/buy', [CarController::class, 'buy']);
    Route::apiResource('cars', CarController::class);

    // Motors
    Route::get('motors/report', [MotorController::class, 'report']);
    Route::put('motors/{motor}/buy', [MotorController::class, 'buy']);
    Route::apiResource('motors', MotorController::class);
});
    


// Route::group(['middleware' => ['jwt.verify']], function () {
//     Route::delete('authentications', [ApiController::class, 'logout']);
//     Route::apiResource("vehicles", \App\Http\Controllers\VehicleController::class)->except('store');
//     Route::post('vehicles/motors', [\App\Http\Controllers\VehicleController::class, 'storeMotor']);
//     Route::post('vehicles/cars', [\App\Http\Controllers\VehicleController::class, 'storeCar']);
// });
