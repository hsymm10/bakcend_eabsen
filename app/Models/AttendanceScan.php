<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceScan extends Model
{
    protected $fillable = [
        'session_id',
        'nis',
        'nama',
        'kelas',
        'status',
        'waktu_absen',
    ];

    protected $casts = [
        'waktu_absen' => 'datetime'
    ];
}
