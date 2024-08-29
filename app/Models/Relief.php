<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Relief extends Model
{
    use HasFactory;

    protected $fillable = [
        'branche_id',
        'place_id',
        'relief_in_id',
        'relief_out_id',
        'status'
    ];
    
    public function branche(): BelongsTo
    {
        return $this->belongsTo(Branche::class);
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    public function relief_in(): BelongsTo
    {
        return $this->belongsTo(ReliefIn::class);
    }

    public function relief_out(): BelongsTo
    {
        return $this->belongsTo(Reliefout::class);
    }
}
