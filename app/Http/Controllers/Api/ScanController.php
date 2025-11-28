<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScanController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Scan Controller Index'
        ]);
    }
    
    public function getClasses()
    {
        $classes = Student::select('kelas')
            ->distinct()
            ->orderBy('kelas')
            ->pluck('kelas');

        return response()->json([
            'success' => true,
            'data' => $classes
        ]);
    }

    public function getStudentsByClass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kelas' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $students = Student::where('kelas', $request->kelas)
            ->orderBy('nama')
            ->get(['nis', 'nama', 'kelas']);  // HAPUS jurusan

        return response()->json([
            'success' => true,
            'data' => $students
        ]);
    }
}
