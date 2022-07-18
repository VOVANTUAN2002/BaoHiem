<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // add soft delete
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\HasPermissions;

class UserGroup extends Model
{
    use HasApiTokens, HasFactory;
    use Notifiable, HasPermissions, SoftDeletes;// add soft delete
    protected $table = 'user_groups';

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function roles() {
        return $this->belongsToMany(Role::class,'user_group_roles','user_group_id','role_id');
    }
}
