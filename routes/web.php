<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

\Illuminate\Support\Facades\Auth::routes();
Route::get('/', function () {
    return redirect()->route('car.index');
});
Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', UserController::class);
    Route::resource('car', CarController::class);
    Route::put('car/{car}/reserve', [CarController::class, 'reserve'])->name('car.reserve');
});
