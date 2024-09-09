<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaintenanceRoundDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'maintenance_round_id',
        'site_id',
        'detail',
    ];

    protected function casts(): array
    {
        return [
            'detail' => 'array',
        ];
    }

    public function maintenance_round(): BelongsTo
    {
        return $this->belongsTo(MaintenanceRound::class);
    }

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }
}
