<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ElementDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'maintenance_round_detail_id',
        'element_id',
        'status',
        'detail',
    ];

    public function maintenance_round_detail():BelongsTo
    {
        return $this->belongsTo(MaintenanceRoundDetail::class);
    }

    public function element():BelongsTo
    {
        return $this->belongsTo(Element::class);
    }
}
