<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function items()
    {
        return $this->belongsToMany(Product::class, 'order_has__products');
    }
}
