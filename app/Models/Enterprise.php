<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Enterprise extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'ruc',
        'cellphone',
        'address',
        'legal_representative',
        'email',
        'img',
    ];

    public function branches(): HasMany
    {
        return $this->hasMany(Branche::class);
    }
}
