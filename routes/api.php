<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\GuruPiketController;

// Route::get('/login', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/operator', [OperatorController::class, 'index']);
Route::post('/login/operator', [OperatorController::class, 'login']);

Route::get('/guru_piket', [GuruPiketController::class, 'index']);
Route::post('login/guru_piket', [GuruPiketController::class, 'login']);

Route::get('/walas', [App\Http\Controllers\WalasController::class, 'index']);
Route::post('login/walas', [App\Http\Controllers\WalasController::class, 'login']);