<?php

use App\Http\Controllers\AbsenController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AbsenController::class, 'index']);
Route::post('/postAbsen', [AbsenController::class, 'store']);
// Route::get('/jamkeluar', [AbsenController::class, 'edit']);
// Route::delete('/postAbsen', [AbsenController::class, 'destroy']);
// Route::get('/absen/edit/{id}', [AbsenController::class, 'edit']);

Route::get('absen/edit/{id}', [AbsenController::class, 'edit']);
Route::put('absen/{id}', [AbsenController::class, 'update']);
Route::get('absen/jamkeluar/edit/{id}', [AbsenController::class, 'editKeluar']);
Route::put('absen/jamkeluar/{id}', [AbsenController::class, 'updateKeluar']);
Route::delete('absen/{id}', [AbsenController::class, 'destroy']);

