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
    Route::get('vehicles/stock', [VehicleController::class, 'stock']);
    Route::get('vehicles/sales', [VehicleController::class, 'sales']);
    Route::apiResource('vehicles', VehicleController::class);

    // Cars
    Route::get('cars', [CarController::class, 'index']);
    Route::get('cars/sales', [CarController::class, 'sales']);
    Route::get('cars/stock', [CarController::class, 'stock']);

    // Motors
    Route::get('motors', [MotorController::class, 'index']);
    Route::get('motors/sales', [MotorController::class, 'sales']);
    Route::get('motors/stock', [MotorController::class, 'stock']);
});
