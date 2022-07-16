<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{

    use HasFactory;
    protected $table = 'user_groups';

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function roles() {
        return $this->belongsToMany(Role::class,'user_group_roles','user_group_id','role_id');
    }
}
