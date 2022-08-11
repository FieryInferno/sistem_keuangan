<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('login');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'auth']);
