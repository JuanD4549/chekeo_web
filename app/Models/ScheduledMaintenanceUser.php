<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ScheduledMaintenanceUser extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'scheduled_maintenance_id',
        'leader',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scheduled_maintenance(): BelongsTo
    {
        return $this->belongsTo(ScheduledMaintenance::class);
    }
}
