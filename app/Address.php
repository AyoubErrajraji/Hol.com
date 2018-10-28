<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_has__addresses');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
