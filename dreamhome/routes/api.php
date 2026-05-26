<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClientAuthController;
use App\Http\Controllers\Api\ClientPropertyController;
use App\Http\Controllers\Api\ClientViewingController;


Route::post('/client/register', [ClientAuthController::class, 'register']);
Route::post('/client/login', [ClientAuthController::class, 'login']);

Route::get('/properties', [ClientPropertyController::class, 'index']);
Route::get('/properties/{id}', [ClientPropertyController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/viewings', [ClientViewingController::class, 'store']);
    Route::get('/my-viewings', [ClientViewingController::class, 'myViewings']);
    Route::post('/logout', [ClientAuthController::class, 'logout']);
});