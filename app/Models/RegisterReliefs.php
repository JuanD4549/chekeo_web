<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegisterReliefs extends Model
{
    use HasFactory;
    protected $fillable = [
        'relief_id',
        'user_id',
        'date_time',
        'status',
        'turn',
        'detail',
        'latitude',
        'longitude',
        'img1_url',
        'img2_url',
    ];
    public function relief(): BelongsTo
    {
        return $this->belongsTo(Relief::class);
    }
}
