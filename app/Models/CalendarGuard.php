<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarGuard extends Model
{
    use HasFactory;
    protected $fillable = [
        'branche_id',
        'type',
        'day',
        'time_in',
        'time_out',
    ];
    public function branche()
    {
        return $this->belongsTo(Branche::class);
    }
}
