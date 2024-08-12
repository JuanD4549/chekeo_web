<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Visit extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'ci',
        'cellphone',
        'info_visit',
    ];

    public function registration_visits():HasMany
    {
        return $this->hasMany(RegistrationVisit::class);
    }
}
