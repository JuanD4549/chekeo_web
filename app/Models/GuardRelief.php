<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GuardRelief extends Model
{
    use HasFactory;

    protected $fillable = [
        'place_id',
        'user_id',
        'turn_in_id',
        'turn_out_id',
    ];

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function turn_in(): BelongsTo
    {
        return $this->belongsTo(TurnIn::class);
    }

    public function turn_out(): BelongsTo
    {
        return $this->belongsTo(TurnOut::class);
    }
}
