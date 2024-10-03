<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Calendar extends Model
{
    use HasFactory;
    protected $fillable = [
        'range',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
    ];
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
    public function branches(): HasMany
    {
        return $this->hasMany(Branche::class);
    }
    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }
}
