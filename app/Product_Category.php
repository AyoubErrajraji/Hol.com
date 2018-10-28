<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Category extends Model
{
    public function product()
    {
        return $this->hasOne(Product::class);
    }

    public function category()
    {
        return $this->hasOne(Category::class);
    }
}
