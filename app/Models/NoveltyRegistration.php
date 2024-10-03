<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NoveltyRegistration extends Model
{
    use HasFactory;
    protected $fillable = [
        'branche_id',
        'security_guard_id',
        'employee_id',
        'novelty_id',
        'detail_created',
        'latitude',
        'longitude',
        'date_time_close',
        'detail_closed',
        'img1_url',
        'img2_url',
        'img3_url',
        'img4_url',
    ];
    public function branche(): BelongsTo
    {
        return $this->belongsTo(Branche::class);
    }

    public function security_guard(): BelongsTo
    {
        return $this->belongsTo(SecurityGuard::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function novelty(): BelongsTo
    {
        return $this->belongsTo(Novelty::class);
    }
}
