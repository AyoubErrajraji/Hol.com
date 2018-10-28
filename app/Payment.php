<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public function type()
    {
        return $this->hasOne(PaymentType::class);
    }
}
