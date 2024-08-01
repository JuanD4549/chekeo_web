<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'date_time',
        'detail',
        'latitude',
        'longitude',
        'img1_url',
        'img2_url',
    ];
    public function detail_ins():HasMany
    {
        return $this->hasMany(DetailIn::class);
    }
    public function detail_outs():HasMany
    {
        return $this->hasMany(DetailOut::class);
    }
}
