<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('login');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'auth']);

Route::middleware('auth')->group(function () {
  Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);
  Route::resource('karyawan', App\Http\Controllers\UserController::class);
  Route::resource('barang', App\Http\Controllers\BarangController::class);
  Route::resource('pemasukan', App\Http\Controllers\PemasukanController::class);
});
