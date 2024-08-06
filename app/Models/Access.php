<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Access extends Model
{
    use HasFactory;

    protected $fillable = [
        'branche_id',
        'user_id',
        'date_time_in',
        'date_time_out',
    ];

    public function branche(): BelongsTo
    {
        return $this->belongsTo(Branche::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
