<?php

use Illuminate\Support\Facades\Route;

// Admin Routes
Route::group(['namespace' => 'Customer', 'middleware' => ['auth:web', 'customer'], 'prefix' => 'customer'], function () {
         Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('/expensive/{id}', [App\Http\Controllers\ExpensiveController::class, 'index'])->name('expensive');
   
});