<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function state()
    {
        return $this->belongsTo(OrderState::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_has__products')->withPivot('amount');
    }
}
