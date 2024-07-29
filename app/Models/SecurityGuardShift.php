<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SecurityGuardShift extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'branche_id',
        'relief',
        'status',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function branche(): BelongsTo
    {
        return $this->belongsTo(Branche::class);
    }
    public function data_security_guard_shifts()
    {
        return $this->hasMany(DataSecurityGuardShift::class);
    }
}
