<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ScheduledMaintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
        'priority',
        'description',
        'pass_time',
        'in_day_time',
        'type',
        'days',
        'months',
        'for_days',
        'days_num',
        'the',
    ];

    protected $casts = [
        'for_days' => 'boolean',
        'in_day_time' => 'array',
        'days' => 'array',
        'months' => 'array',
        'days_num' => 'array',
        'the' => 'array',
    ];

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }

    public function scheduled_maintenance_user(): HasMany
    {
        return $this->hasMany(ScheduledMaintenanceUser::class);
    }
}
