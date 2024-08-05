<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReliefIn extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'detail_in_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function detail_in():BelongsTo
    {
        return $this->belongsTo(DetailIn::class);
    }
}
