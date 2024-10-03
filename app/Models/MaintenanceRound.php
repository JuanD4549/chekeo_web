<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MaintenanceRound extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
    public function maintenance_round_details(): HasMany
    {
        return $this->hasMany(MaintenanceRoundDetail::class);
    }
}
