<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SecurityGuardShift extends Model
{
    use HasFactory;
    protected $fillable = [
        'security_guard_id',
        'branche_id',
        'place_id',
        'detail_in_id',
        'detail_out_id',
        'status',
    ];

    public function security_guard(): BelongsTo
    {
        return $this->belongsTo(SecurityGuard::class);
    }

    public function branche(): BelongsTo
    {
        return $this->belongsTo(Branche::class);
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }
    public function detail_in(): BelongsTo
    {
        return $this->belongsTo(DetailIn::class);
    }
    public function detail_out(): BelongsTo
    {
        return $this->belongsTo(DetailOut::class);
    }
}
