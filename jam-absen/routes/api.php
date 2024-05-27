<?php

use App\Http\Controllers\Api\ApiAbsenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::get('/absen', [ApiAbsenController::class, 'index']);
// Route::post('/absen', [ApiAbsenController::class, 'store']);
// Route::put('/absen/{id}', [ApiAbsenController::class, 'update']);
// Route::delete('/absen/{id}', [ApiAbsenController::class, 'destroy']);

Route::apiResource('/absen', ApiAbsenController::class);