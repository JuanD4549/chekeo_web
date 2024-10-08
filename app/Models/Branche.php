<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branche extends Model
{
    use HasFactory;
    protected $fillable=[
        'enterprise_id',
        'user_id',
        'calendar_id',
        'name',
        'address',
        'status',
    ];

    public function enterprise(): BelongsTo
    {
        return $this->belongsTo(Enterprise::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }
    public function calendar():BelongsTo
    {
        return $this->belongsTo(Calendar::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function reliefs()
    {
        return $this->hasMany(Relief::class);
    }
}
