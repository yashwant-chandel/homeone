<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    public function orders(){
         return $this->hasMany(Order::class,'order_num','order_num');
    }
    public function address(){
        return $this->hasOne(Address::class,'order_num','order_num');
    }
}
