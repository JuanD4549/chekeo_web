<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends User
{
    use HasFactory;
    protected $table = 'users';

    public function calendars()
    {
        return $this->belongsToMany(Calendar::class,'calendar_user','calendar_id','user_id');
    }
}
