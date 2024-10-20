<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SecurityGuard extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'branche_id',
        'calendar_id',
        'place_id',
        'name',
        'ci',
        'blood_type',
        'drive_license',
        'email',
        'cellphone',
        'phone',
        'address',
        'charge',
        'country',
        'province',
        'city',
        'date_in',
        'enterprise_mail',
        'enterpriser_phone',
        'enterpriser_phone_ext',
        'type_empleado',
        'status',
    ];

    public function calendars(): BelongsToMany
    {
        return $this->belongsToMany(Calendar::class, 'calendar_user', 'calendar_id', 'user_id');
    }
    //Relations

    public function security_guard_shifts(): HasMany
    {
        return $this->hasMany(SecurityGuardShift::class);
    }

    public function calendar(): BelongsTo
    {
        return $this->belongsTo(Calendar::class);
    }

    public function branche(): BelongsTo
    {
        return $this->belongsTo(Branche::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }


}
