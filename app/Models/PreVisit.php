<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PreVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'img_url',
        'visit_id',
        'date_time_in',
        'status',
        'pin',
    ];
    protected $casts = [
        'status' => 'boolean',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }
}
