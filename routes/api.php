<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::post('users', [ApiController::class, 'register']);
Route::post('authentications', [ApiController::class, 'authenticate']);

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::delete('authentications', [ApiController::class, 'logout']);
    Route::apiResource("vehicles", \App\Http\Controllers\VehicleController::class)->except('store');
    Route::post('vehicles/motors', [\App\Http\Controllers\VehicleController::class, 'storeMotor']);
    Route::post('vehicles/cars', [\App\Http\Controllers\VehicleController::class, 'storeCar']);
});
