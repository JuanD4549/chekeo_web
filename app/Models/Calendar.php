<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Calendar extends Model
{
    use HasFactory;
    protected $fillable=[
        'day',
        'time_in',
        'time_out',
    ];
    public function users():BelongsToMany{
        return $this->belongsToMany(User::class);
    }
    public function branches():BelongsToMany{
        return $this->belongsToMany(Branche::class);
    }
}
