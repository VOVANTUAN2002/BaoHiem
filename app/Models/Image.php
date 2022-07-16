<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table = 'images';

    public function insurances()
    {
        return $this->belongsTo(Insurance::class, 'Insurance_id', 'id');
    }
}
