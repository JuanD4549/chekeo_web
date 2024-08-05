<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DetailIn extends Model
{
    use HasFactory;

    protected $fillable = [
        'detail_id',
    ];

    public function security_guard_shift(): HasOne
    {
        return $this->hasOne(SecurityGuardShift::class);
    }

    public function relief_in(): HasOne
    {
        return $this->hasOne(ReliefIn::class);
    }

    public function detail(): BelongsTo
    {
        return $this->belongsTo(Detail::class);
    }
}
