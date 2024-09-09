<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserWorkOrder extends Pivot
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'work_order_id',
        'leader'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
 
    public function work_order(): BelongsTo
    {
        return $this->belongsTo(WorkOrder::class);
    }
}
