<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NoveltyRegistration extends Model
{
    use HasFactory;
    protected $fillable=[
        'branche_id',
        'user_id',
        'user_notificad_id',
        'catalog_novelty_id',
        'detail_created',
        'date_time_close',
        'detail_closed',
        'img1_url',
        'img2_url',
        'img3_url',
        'img4_url',
    ];
    public function branche(): BelongsTo
    {
        return $this->belongsTo(Branche::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
}
