<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use App\Models\Student;
use App\Models\User;

class OperatorController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Misalnya operator disimpan di users table dengan role 'operator'
        $credentials = $request->only('email', 'password');

        // Autentikasi manual, bisa disesuaikan sesuai sistem user
        $user = \App\Models\User::where('email', $credentials['email'])
            ->whereJsonContains('roles', 'operator')  // contoh filter role operator
            ->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'Email atau password salah'], 401);
        }

        // Bisa tambahkan token API kalau pakai Laravel Sanctum, misal:
        $token = $user->createToken('operator-token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function importCsv(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|file|mimes:csv,txt|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $file   = $request->file('csv_file');
        $path   = $file->getRealPath();
        $handle = fopen($path, 'r');

        if ($handle === false) {
            return response()->json(['message' => 'Gagal membuka file'], 500);
        }

        // HEADER WAJIB (boleh urutan bebas): kelas, nis, nama, jurusan
        $header = fgetcsv($handle, 0, ',');
        $header = array_map(fn($h) => strtolower(trim($h)), $header);

        $rows = 0;

        while (($row = fgetcsv($handle, 0, ',')) !== false) {
            // kalau jumlah kolom tidak sama dengan header, skip
            if (count($row) !== count($header)) {
                continue;
            }

            $data = array_combine($header, $row);

            // minimal nis & nama wajib diisi
            if (empty($data['nis']) || empty($data['nama'])) {
                continue;
            }

            Student::updateOrCreate(
                ['nis' => trim($data['nis'])],
                [
                    'nama'    => trim($data['nama']),
                    'kelas'   => $data['kelas']   ?? null,
                    'jurusan' => $data['jurusan'] ?? null,
                ]
            );

            $rows++;
        }

        fclose($handle);

        return response()->json([
            'message'   => 'Import CSV berhasil',
            'processed' => $rows,
        ]);
    }

    public function index(Request $request)
    {
        $query = Student::query();

        // filter by kelas (dipakai Vue)
        if ($request->filled('kelas')) {
            $query->where('kelas', $request->kelas);
        }

        // opsional: filter by nis
        if ($request->filled('nis')) {
            $query->where('nis', $request->nis);
        }

        // opsional: filter by nama (like)
        if ($request->filled('nama')) {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }

        // opsional: filter by jurusan (like)
        if ($request->filled('jurusan')) {
            $query->where('jurusan', 'like', '%' . $request->jurusan . '%');
        }

        $students = $query
            ->orderBy('kelas')
            ->orderBy('nama')
            ->get();

        return response()->json([
            'data' => $students,
        ]);
    }

    // POST /api/forgot-password
    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        // kirim email reset password ke Gmail user
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json([
                'message' => 'Link reset password telah dikirim ke email Anda.',
                'status'  => __($status),
            ], 200);
        }

        return response()->json([
            'message' => 'Gagal mengirim link reset password.',
            'status'  => __($status),
        ], 400);
    }

    // POST /api/reset-password
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token'                 => ['required'],
            'email'                 => ['required', 'email', 'exists:users,email'],
            'password'              => ['required', 'string', 'min:6', 'confirmed'],
            // harus ada field password_confirmation di body
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json([
                'message' => 'Password berhasil direset. Silakan login kembali.',
                'status'  => __($status),
            ], 200);
        }

        return response()->json([
            'message' => 'Token atau email tidak valid / kadaluarsa.',
            'status'  => __($status),
        ], 400);
    }
}
