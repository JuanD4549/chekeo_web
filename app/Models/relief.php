<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class relief extends Model
{
    use HasFactory;
    protected $fillable = [
        'branche_id',
        'relief_in_id',
        'relief_out_id',
    ];
    public function relief_in()
    {
        return $this->belongsTo(ReliefIn::class);
    }
    public function relief_out()
    {
        return $this->belongsTo(Reliefout::class);
    }
}
