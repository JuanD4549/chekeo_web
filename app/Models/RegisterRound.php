<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RegisterRound extends Model
{
    use HasFactory;
    protected $fillable = [
        'branche_id',
        'place_id',
        'security_guard_id',
        'date_time_closed',
        'detail_close',
    ];

    public function branche(): BelongsTo
    {
        return $this->belongsTo(Branche::class);
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    public function security_guard(): BelongsTo
    {
        return $this->belongsTo(SecurityGuard::class);
    }

    public function rounds(): HasMany
    {
        return $this->hasMany(Round::class);
    }
}
