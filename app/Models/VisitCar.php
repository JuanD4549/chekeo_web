<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VisitCar extends Model
{
    use HasFactory;

    protected $fillable=[
        'license_plate'
    ];

    public function registration_visits():HasMany
    {
        return $this->hasMany(RegistrationVisit::class);
    }
}
