<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QrSession extends Model
{
    protected $fillable = [
        'code',
        'qr_text',
        'size',
        'expiry_time',
        'is_active',
        'generated_by',
    ];
}
