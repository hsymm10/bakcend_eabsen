<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DataGuruController extends Controller
{
    public function index(Request $request)
    {
        $gurus = User::query()
            ->where(function ($q) {
                $q->whereJsonContains('roles', 'guru_piket')
                    ->orWhereJsonContains('roles', 'walas');
            })
            ->select('id', 'name', 'email', 'roles')
            ->orderBy('name')
            ->get();

        return response()->json($gurus);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi: roles array berisi walas/guru_piket; password opsional
        $validated = $request->validate([
            'roles'    => ['required', 'array'],
            'roles.*'  => ['in:walas,guru_piket'],
            'password' => ['nullable', 'string'],
        ]);

        // update roles (JSON)
        $user->roles = $validated['roles'];

        // jika password diisi, update dan hash
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return response()->json([
            'message' => 'Data guru berhasil diperbarui',
            'user'    => $user,
        ]);
    }
}
