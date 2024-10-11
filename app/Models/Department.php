<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'branche_id',
        'employee_id',
        'calendar_id',
        'name',
    ];
    public function branche(): BelongsTo
    {
        return $this->belongsTo(Branche::class);
    }
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
    public function calendar(): BelongsTo
    {
        return $this->belongsTo(Calendar::class);
    }
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
