<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishListItem extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function wishlist()
    {
        return $this->belongsTo(WishList::class);
    }
}
