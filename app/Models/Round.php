<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Round extends Model
{
    use HasFactory;
    protected $fillable = [
        'register_round_id',
        'latitude',
        'longitude',
        'img1_url',
    ];

    public function register_round(): BelongsTo
    {
        return $this->belongsTo(RegisterRound::class);
    }
}
