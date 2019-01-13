<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishListItem extends Model
{
    public function product()
    {
        return $this->hasOne(Product::class);
    }

    public function wishlist()
    {
        return $this->hasOne(WishList::class);
    }
}
