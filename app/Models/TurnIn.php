<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TurnIn extends Model
{
    use HasFactory;

    protected $fillable = [
        'security_guard_id'
    ];

    public function security_guard(): BelongsTo
    {
        return $this->belongsTo(SecurityGuard::class);
    }
}
