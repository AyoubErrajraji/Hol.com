<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    public function payment()
    {
        return $this->belongsToMany(Payment::class);
    }
}
