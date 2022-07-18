<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // add soft delete
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\HasPermissions;
class Insurance extends Model
{
    use HasApiTokens, HasFactory;
    use Notifiable, HasPermissions, SoftDeletes;// add soft delete
    protected $table = 'insurances';

    public function insurance_images()
    {
        return $this->hasMany(Image::class);
    }
}
