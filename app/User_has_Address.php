<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_has_Address extends Model
{
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
