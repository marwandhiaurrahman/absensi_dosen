<?php

use App\Http\Controllers\API\AbsensiController;
use App\Http\Controllers\API\RegisterController;
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

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);

Route::middleware('auth:api')->group( function () {
    Route::get('dashboard', [AbsensiController::class, 'dashboard']);
    Route::get('jadwalsaya', [AbsensiController::class, 'jadwals']);
    Route::get('absensi/{id}', [AbsensiController::class, 'getabsensi']);
    Route::post('absensi/masuk', [AbsensiController::class, 'masukabsensi']);
    Route::put('absensi/keluar/{id}', [AbsensiController::class, 'keluarabsensi']);
    Route::get('location', [AbsensiController::class, 'getlocation']);

});
