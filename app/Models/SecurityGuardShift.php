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
        'turn',
        'type',
        'detail',
        'latitude_in',
        'longitude_in',
        'latitude_out',
        'longitude_out',
        'img1_url_in',
        'img2_url_in',
        'img1_url_out',
        'img2_url_out',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
