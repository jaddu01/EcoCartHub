<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['product_name', 'brand', 'description', 'quantity', 'product_price', 'color'];
    // protected $guarded = [];

    public function images(){

        return $this->hasMany(ProductImage::class);

    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function cart_items(){

        return $this->belongsTo(CartItem::class);

    }
}
