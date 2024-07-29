<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReliefOut extends Model
{
    use HasFactory;
    protected $fillable = [
        'security_guard_shift_id',
    ];
    public function security_guard_shift()
    {
        return $this->belongsTo(SecurityGuardShift::class);
    }
}
