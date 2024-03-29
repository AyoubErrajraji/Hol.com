<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_has__products');
    }

    public function cartitem()
    {
        return $this->hasMany(CartItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function wishlists()
    {
        return $this->belongsToMany(WishList::class, 'wish_list_items');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_has__products')->withPivot('amount');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product__categories');
    }
}
