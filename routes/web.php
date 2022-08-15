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
  Route::get('pemasukan/barangJasa', [App\Http\Controllers\PemasukanController::class, 'getBarangJasa']);
  Route::resource('pemasukan', App\Http\Controllers\PemasukanController::class);
  Route::resource('pengeluaran', App\Http\Controllers\PengeluaranController::class);
  Route::resource('jasa', App\Http\Controllers\JasaController::class);
  Route::post('logout', [App\Http\Controllers\LoginController::class, 'logout']);
  Route::get('jurnal', [App\Http\Controllers\JurnalController::class, 'index']);
});
