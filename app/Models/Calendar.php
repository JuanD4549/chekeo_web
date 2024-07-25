<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory;
    protected $fillable=[
        'day',
        'time_in',
        'time_out',
    ];
    public function users(){
        return $this->belongsToMany(User::class);
    }
    public function branches(){
        return $this->belongsToMany(Branche::class);
    }
}
