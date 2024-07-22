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
        'date_time_in',
        'date_time_out',
        'status',
        'turn',
        'detail',
        'latitude',
        'longitude',
        'img1_url',
        'img2_url',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
