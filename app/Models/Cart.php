<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;



    public function user_cart(){

        return $this->belongsTo(User::class);
    }

    public function cart_items(){

        return $this->hasMany(CartItem::class);

    }
}
