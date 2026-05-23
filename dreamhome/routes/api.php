<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClientAuthController;
use App\Http\Controllers\Api\ClientPropertyController;
use App\Http\Controllers\Api\ClientViewingController;

/*
|--------------------------------------------------------------------------
| Client Authentication Routes
|--------------------------------------------------------------------------
*/
Route::post('/client/register', [ClientAuthController::class, 'register']);
Route::post('/client/login', [ClientAuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| Public Property Routes
|--------------------------------------------------------------------------
| These can be viewed even before login.
*/
Route::get('/properties', [ClientPropertyController::class, 'index']);
Route::get('/properties/{id}', [ClientPropertyController::class, 'show']);

/*
|--------------------------------------------------------------------------
| Protected Client Routes
|--------------------------------------------------------------------------
| These require login token from Flutter.
*/
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/viewings', [ClientViewingController::class, 'store']);
    Route::get('/my-viewings', [ClientViewingController::class, 'myViewings']);
    Route::post('/logout', [ClientAuthController::class, 'logout']);
});