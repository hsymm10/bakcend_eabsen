<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceSession extends Model
{
    protected $fillable = [
        'code',
        'url',
        'start_time',
        'end_time',
        'created_by',
    ];
}
