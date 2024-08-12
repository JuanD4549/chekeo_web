<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegistrationVisit extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'branche_id',
        'visit_id',
        'visit_car_id',
        'date_time_in',
        'date_time_out',
        'img1_url',
        'img2_url',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function branche(): BelongsTo
    {
        return $this->belongsTo(Branche::class);
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function visit_car(): BelongsTo
    {
        return $this->belongsTo(VisitCar::class);
    }
}
