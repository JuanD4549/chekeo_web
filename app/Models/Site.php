<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function registration_visits(): HasMany
    {
        return $this->hasMany(WorkOrder::class);
    }
    public function elements(): HasMany
    {
        return $this->hasMany(Element::class);
    }

    public function scheduled_maintenance(): HasMany
    {
        return $this->hasMany(ScheduledMaintenance::class);
    }
}
