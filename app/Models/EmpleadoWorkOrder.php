<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EmpleadoWorkOrder extends Pivot
{
    use HasFactory;
    protected $fillable = [
        'Empleado_id',
        'work_order_id',
        'leader'
    ];

    public function empleado(): BelongsTo
    {
        return $this->belongsTo(Empleado::class);
    }

    public function work_order(): BelongsTo
    {
        return $this->belongsTo(WorkOrder::class);
    }
}
