<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderState extends Model
{
    public function order()
    {
        return $this->belongsToMany(Order::class);
    }
}
