<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasPanelShield;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'department_id',
        'branche_id',
        'name',
        'ci',
        'blood_type',
        'drive_license',
        'email',
        'password',
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
        'img',
        'type_user',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function security_guard_shift(): HasMany
    {
        return $this->hasMany(SecurityGuardShift::class);
    }
    public function calendars()
    {
        return $this->belongsToMany(Calendar::class,'user_calendar');
    }
    public function branche()
    {
        return $this->belongsTo(Branche::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
