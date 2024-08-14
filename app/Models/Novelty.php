<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Novelty extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'catalog_novelty_id'
    ];

    public function catalog_novelty(): BelongsTo
    {
        return $this->belongsTo(CatalogNovelty::class);
    }
}
