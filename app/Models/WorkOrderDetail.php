<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkOrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_order_id',
        'advance',
        'detail',
        'img1_url',
        'img2_url',
    ];

    public function work_order(): BelongsTo
    {
        return $this->belongsTo(WorkOrder::class);
    }
}
