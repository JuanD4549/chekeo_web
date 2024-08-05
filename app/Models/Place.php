<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'branche_id',
        'name',
        'num_reliefs',
    ];

    public function branche(): BelongsTo
    {
        return $this->belongsTo(Branche::class);
    }
}
