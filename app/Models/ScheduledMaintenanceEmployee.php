<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ScheduledMaintenanceEmployee extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'scheduled_maintenance_id',
        'leader',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function scheduled_maintenance(): BelongsTo
    {
        return $this->belongsTo(ScheduledMaintenance::class);
    }
}
