<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SecurityGuardShift extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'branche_id',
        'detail_in_id',
        'detail_out_id',
        'relief',
        'status',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function branche(): BelongsTo
    {
        return $this->belongsTo(Branche::class);
    }
    public function detail_in():BelongsTo
    {
        return $this->belongsTo(DetailIn::class);
    }
    public function detail_out():BelongsTo
     {
         return $this->belongsTo(DetailOut::class);
     }
}
