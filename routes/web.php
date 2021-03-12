<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::patch('updateprofile/{id}', [UserController::class, 'updateprofile'])->name('updateprofile');

    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('products', App\Http\Controllers\ProductController::class);
    Route::resource('fakultas', App\Http\Controllers\FakultaController::class);
    Route::resource('prodi', App\Http\Controllers\ProdiController::class);
    Route::resource('kelas', App\Http\Controllers\KelasController::class);
    Route::resource('gedung', App\Http\Controllers\GedungController::class);
    Route::resource('ruangan', App\Http\Controllers\RuanganController::class);
});
