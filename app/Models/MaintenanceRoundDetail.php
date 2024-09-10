<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MaintenanceRoundDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'maintenance_round_id',
        'site_id',
    ];


    public function maintenance_round(): BelongsTo
    {
        return $this->belongsTo(MaintenanceRound::class);
    }

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }

    public function element_detail(): HasMany
    {
        return $this->hasMany(ElementDetail::class);
    }
}
