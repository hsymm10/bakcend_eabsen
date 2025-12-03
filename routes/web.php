<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Api\QrSessionController;

Route::get('/', function () {
    return view('welcome');
});

// API DROPDOWN
Route::get('/api/scan/classes', function () {
    return response()->json([
        'data' => \App\Models\Student::distinct()->pluck('kelas')->sort()
    ]);
});

Route::get('/api/scan/students', function (Request $request) {
    $kelas = $request->query('kelas');
    return response()->json([
        'data' => \App\Models\Student::where('kelas', $kelas)
            ->select('nis', 'nama')->get()
    ]);
});


// ABSENSI
Route::post('/isi_siswa', [StudentController::class, 'isiSiswa']);

// IMPORT SISWA
Route::get('/import-siswa', [StudentController::class, 'importForm'])->name('import.form');
Route::post('/import-siswa', [StudentController::class, 'import'])->name('import.store');

Route::get('/reset-password/{token}', function (Request $request, $token) {
    // Untuk SPA, cukup redirect ke Nuxt dengan query yang sama
    $email = $request->query('email');

    return redirect(config('app.frontend_url', 'http://192.168.1.4:3000')
        . '/reset-password?token=' . $token . '&email=' . urlencode($email));
})->name('password.reset');
