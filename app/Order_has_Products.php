<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_has_Products extends Model
{
    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public function product()
    {
        return $this->hasOne(Product::class);
    }
}
