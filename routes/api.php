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
    // Route::post('kendaraan', [VehicleSalesController::class, 'menambahkanKendaraan']);
    // Route::put('update-kendaraan/{id}', [VehicleSalesController::class, 'updateKendaraan']);
    // Route::get('list-kendaraan', [VehicleSalesController::class, 'listAllKendaraan']);
    Route::apiResource('vehicles', VehicleController::class)->except('destroy');

    // Cars
    // Route::post('mobil', [VehicleSalesController::class, 'menambahkanMobil']);
    // Route::get('list-mobil', [VehicleSalesController::class, 'listKendaraanMobil']);
    // Route::get('detail-mobil/{id}', [VehicleSalesController::class, 'detailMobil']);
    // Route::put('update-mobil/{id}', [VehicleSalesController::class, 'updateMobil']);
    // Route::delete('delete-mobil/{id}', [VehicleSalesController::class, 'deleteMobil']);
    // Route::get('laporan-penjualan-mobil', [VehicleSalesController::class, 'laporanPenjualanMobil']);
    // Route::put('beli-mobil/{id}', [VehicleSalesController::class, 'penjualanMobil']);
    Route::get('cars/report', [CarController::class, 'report']);
    Route::put('cars/{id}/buy', [CarController::class, 'buy']);
    Route::apiResource('cars', CarController::class);

    // Motors
    // Route::post('motor', [VehicleSalesController::class, 'menambahkanMotor']);
    // Route::get('list-motor', [VehicleSalesController::class, 'listKendaraanMotor']);
    // Route::get('detail-motor/{id}', [VehicleSalesController::class, 'detailMotor']);
    // Route::put('update-motor/{id}', [VehicleSalesController::class, 'updateMotor']);
    // Route::delete('delete-motor/{id}', [VehicleSalesController::class, 'deleteMotor']);
    // Route::put('beli-motor/{id}', [VehicleSalesController::class, 'penjualanMotor']);
    // Route::get('laporan-penjualan-motor', [VehicleSalesController::class, 'laporanPenjualanMotor']);
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
