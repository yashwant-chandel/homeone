<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExteriorMeta extends Model
{
    use HasFactory;
    public function images(){
        return $this->hasMany(Media::class,'exterior_id','id');
    }
}
