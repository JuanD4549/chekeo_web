<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ControlSupervisory extends Model
{
    use HasFactory;

    protected $fillable = [
        'branche_id',
        'user_id',
        'date_time_closed',
        'detail_closed',
    ];

    public function branche(): BelongsTo
    {
        return $this->belongsTo(Branche::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function detail_control_supervisories():HasMany
    {
        return $this->hasMany(DetailControlSupervisory::class);
    }

}
