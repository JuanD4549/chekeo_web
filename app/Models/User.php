<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasPanelShield;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';

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
        'avatar_url',
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
    //Filament
    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url;
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

    public function accesses(): HasMany
    {
        return $this->hasMany(Access::class);
    }

    public function representativeUsers(): HasMany
    {
        return $this->hasMany(RepresentativeUser::class);
    }

    public function user_work_order(): HasMany
    {
        return $this->hasMany(UserWorkOrder::class);
    }
}
