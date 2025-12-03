<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function importForm()
    {
        return view('import-students');
    }
    
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xlsx,xls|max:5120'
        ]);
        
        Excel::import(new StudentsImport, $request->file('file'));
        
        return back()->with('success', 'Import siswa berhasil!');
    }
}
