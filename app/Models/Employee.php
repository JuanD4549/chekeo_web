<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Employee extends User
{
    use HasFactory;
    protected $table = 'users';

    public function calendars():BelongsToMany
    {
        return $this->belongsToMany(Calendar::class,'calendar_user','calendar_id','user_id');
    }
}
