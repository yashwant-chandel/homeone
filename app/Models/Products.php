<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    public function category(){
        return $this->hasOne(Category::class,'id','cat_id');
    }

        // protected $casts = [
        //     'images' => 'array', 
        // ];
    
        public function gallery()
        {
            return $this->hasMany(Media::class, 'id', 'images');
        }
        public function mediaImages()
        {
            return $this->belongsToMany(Media::class,'id' ,'images');
        }
        
    
    
}
