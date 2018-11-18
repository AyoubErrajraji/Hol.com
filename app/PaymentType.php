<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    public function payment()
    {
        return $this->hasMany(Payment::class, 'type_id');
    }
}
