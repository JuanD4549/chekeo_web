<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'auto_generated',
        'site_id',
        'description',
        'priority',
        'state',
        'date_time_closed',
        'img1_url',
        'img2_url',
    ];
    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }

    public function employee(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class)->withPivot('leader');
    }

    public function work_order_details(): HasMany
    {
        return $this->hasMany(WorkOrderDetail::class);
    }

    public function employee_work_order(): HasMany
    {
        return $this->hasMany(EmployeeWorkOrder::class);
    }
}
