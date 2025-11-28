<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\GuruPiketController;
use App\Http\Controllers\WalasController;
use App\Http\Controllers\Api\ScanController;

// Route::get('/login', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/operator', [OperatorController::class, 'index']);
Route::post('/login/operator', [OperatorController::class, 'login']);

Route::get('/guru_piket', [GuruPiketController::class, 'index']);
Route::post('login/guru_piket', [GuruPiketController::class, 'login']);

Route::get('/walas', [WalasController::class, 'index']);
Route::post('login/walas', [WalasController::class, 'login']);

Route::prefix('scan')->group(function () {
    Route::get('/', [ScanController::class, 'index']);
    Route::get('/classes', [ScanController::class, 'getClasses']);
    Route::get('/students', [ScanController::class, 'getStudentsByClass']);
    
});