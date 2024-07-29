<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSecurityGuardShift extends Model
{
    use HasFactory;
    protected $fillable = [
        'security_guard_shift_id',
        'type',
        'date_time',
        'detail',
        'latitude',
        'longitude',
        'img1_url',
        'img2_url',
    ];
    public function security_guard_shift()
    {
        return $this->belongsTo(SecurityGuardShift::class);
    }
}
