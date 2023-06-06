<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

Route::group(['jwt.verify'], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);
    Route::get('list-kendaraan', [VehicleSalesController::class, 'listAllKendaraan']);
    Route::get('list-mobil', [VehicleSalesController::class, 'listKendaraanMobil']);
    Route::get('list-motor', [VehicleSalesController::class, 'listKendaraanMotor']);

    Route::get('detail-mobil/{id}', [VehicleSalesController::class, 'detailMobil']);
    Route::get('detail-motor/{id}', [VehicleSalesController::class, 'detailMotor']);

    Route::get('laporan-penjualan-mobil', [VehicleSalesController::class, 'laporanPenjualanMobil']);
    Route::get('laporan-penjualan-motor', [VehicleSalesController::class, 'laporanPenjualanMotor']);

    Route::put('update-kendaraan/{id}', [VehicleSalesController::class, 'updateKendaraan']);
    Route::put('update-mobil/{id}', [VehicleSalesController::class, 'updateMobil']);
    Route::put('update-motor/{id}', [VehicleSalesController::class, 'updateMotor']);

    Route::delete('delete-mobil/{id}', [VehicleSalesController::class, 'deleteMobil']);
    Route::delete('delete-motor/{id}', [VehicleSalesController::class, 'deleteMotor']);

    Route::put('beli-mobil/{id}', [VehicleSalesController::class, 'penjualanMobil']);
    Route::put('beli-motor/{id}', [VehicleSalesController::class, 'penjualanMotor']);

    Route::post('kendaraan', [VehicleSalesController::class, 'menambahkanKendaraan']);
    Route::post('mobil', [VehicleSalesController::class, 'menambahkanMobil']);
    Route::post('motor', [VehicleSalesController::class, 'menambahkanMotor']);
});
    


// Route::group(['middleware' => ['jwt.verify']], function () {
//     Route::delete('authentications', [ApiController::class, 'logout']);
//     Route::apiResource("vehicles", \App\Http\Controllers\VehicleController::class)->except('store');
//     Route::post('vehicles/motors', [\App\Http\Controllers\VehicleController::class, 'storeMotor']);
//     Route::post('vehicles/cars', [\App\Http\Controllers\VehicleController::class, 'storeCar']);
// });
