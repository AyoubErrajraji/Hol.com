<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{

    protected $fillable = ['product_id','cart_id'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
