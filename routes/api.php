<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\GuruPiketController;
use App\Http\Controllers\WalasController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Api\DataGuruController;
use PhpOffice\PhpSpreadsheet\Calculation\Engine\Operands\Operand;

// Route::get('/login', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/operator', [OperatorController::class, 'index']);
Route::post('/login/operator', [OperatorController::class, 'login']);

Route::get('/guru_piket', [GuruPiketController::class, 'index']);
Route::post('login/guru_piket', [GuruPiketController::class, 'login']);

Route::get('/walas', [WalasController::class, 'index']);
Route::post('login/walas', [WalasController::class, 'login']);

Route::post('/isi_siswa', [StudentController::class . 'isiSiswa'])->name('isi.siswa');

Route::get('/scan/classes', function () {
    return response()->json([
        'data' => \App\Models\Student::distinct()->pluck('kelas')->sort()
    ]);
});

Route::get('/scan/students', function (Request $request) {
    $kelas =  $request->query('kelas');
    return response()->json([
        'data' => \App\Models\Student::where('kelas', $kelas)->select('nis', 'nama')->get()
    ]);
});

Route::get('/data-siswa', [OperatorController::class, 'index']);
Route::post('/data-siswa/importCsv', [OperatorController::class, 'importCsv'])->name('operator.import.csv');

Route::get('/data-guru', [DataGuruController::class, 'index']);
Route::put('/data-guru/{id}', [DataGuruController::class, 'update']);
Route::post('/forgot-password', [OperatorController::class, 'forgotPassword'])->name('operator.forgot.password');
Route::post('/reset-password', [OperatorController::class, 'resetPassword'])->name('operator.forgot.password');
