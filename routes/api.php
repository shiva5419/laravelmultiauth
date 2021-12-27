<?php

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

Route::post('/login', [App\Http\Controllers\Api\LoginController::class, 'login']);

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('categorylist', [App\Http\Controllers\Api\CategoryController::class, 'index']);
    Route::post('add_expensive', [App\Http\Controllers\Api\CategoryController::class, 'add_expensive']);
    Route::get('expensivelist', [App\Http\Controllers\Api\CategoryController::class, 'expensive_list']);

   // Route::resource('users', 'UserController');
});

