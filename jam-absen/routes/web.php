<?php

use App\Http\Controllers\AbsenController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AbsenController::class, 'index']);
Route::post('/postAbsen', [AbsenController::class, 'store']);
// Route::get('/jamkeluar', [AbsenController::class, 'edit']);
// Route::delete('/postAbsen', [AbsenController::class, 'destroy']);
// Route::get('/absen/{id}', [AbsenController::class, 'edit']);
