<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
// Admin Routes

//'middleware' => ['auth:admin'],
Route::group(['namespace' => 'Admin',   'prefix' => 'admin'], function () {

        Route::get('/', [AdminController::class, 'index'])->name('home');
        //Route::post('login', [AdminController::class, 'index'])->name('login');

        


        Route::get('forget-password', [App\Http\Controllers\Admin\ForgotPasswordController::class, 'ForgetPassword'])->name('ForgetPasswordGet');
        Route::post('forget-password', [App\Http\Controllers\Admin\ForgotPasswordController::class, 'ForgetPasswordStore'])->name('ForgetPasswordPost');
        Route::get('reset-password/{token}', [App\Http\Controllers\Admin\ForgotPasswordController::class, 'ResetPassword'])->name('ResetPasswordGet');
        Route::post('reset-password', [App\Http\Controllers\Admin\ForgotPasswordController::class, 'ResetPasswordStore'])->name('ResetPasswordPost');

   
});