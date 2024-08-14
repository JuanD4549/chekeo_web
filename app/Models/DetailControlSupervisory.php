<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailControlSupervisory extends Model
{
    use HasFactory;
    protected $fillable = [
        'place_id',
        'control_supervisory_id',
        'list_checked',
    ];

    protected $casts = [
        'list_checked' => 'array',
    ];

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    public function control_supervisory(): BelongsTo
    {
        return $this->belongsTo(ControlSupervisory::class);
    }
}
