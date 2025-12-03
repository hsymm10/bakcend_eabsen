<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentsImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Student([
            'nis'   => $row['nis'],
            'nama'  => trim($row['nama']),
            'kelas' => $row['kelas'],
        ]);
    }

    public function rules(): array
    {
        return [
            'nis'   => 'required|unique:students,nis',
            'nama'  => 'required|string|max:255',
            'kelas' => 'required|string|max:20',
        ];
    }
}
