<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'branche_id',
        'calendar_id',
        'place_id',
        'user_id',
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
        'status',
    ];

    //Relations
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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

    public function empleado_work_order(): HasMany
    {
        return $this->hasMany(EmployeeWorkOrder::class);
    }

    public function scheduled_maintenance_empleado(): HasMany
    {
        return $this->hasMany(ScheduledMaintenanceEmployee::class);
    }
    public function accesses(): HasMany
    {
        return $this->hasMany(Access::class);
    }
}
