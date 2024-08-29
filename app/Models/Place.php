<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'branche_id',
        'name',
        'type',
    ];

    public function branche(): BelongsTo
    {
        return $this->belongsTo(Branche::class);
    }

    public function guard_reliefs(): HasMany
    {
        return $this->hasMany(GuardRelief::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function rounds(): HasMany
    {
        return $this->hasMany(Round::class);
    }
}
