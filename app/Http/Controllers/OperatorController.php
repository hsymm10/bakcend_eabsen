<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OperatorController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'Operator Controller Index']);
    }

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
}
