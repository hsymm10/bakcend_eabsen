<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'nis',
        'nama',
        'kelas',
    ];

    public function scopeByKelas($query, $kelas)
    {
        return $query->where('kelas', $kelas);
    }
}
