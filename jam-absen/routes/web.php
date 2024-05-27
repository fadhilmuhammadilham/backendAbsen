<?php

use App\Http\Controllers\AbsenController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AbsenController::class, 'index']);
Route::post('/postAbsen', [AbsenController::class, 'store']);
