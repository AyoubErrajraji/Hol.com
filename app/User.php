<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function settings()
    {
        return $this->hasOne(Settings::class);
    }

    public function wishlists()
    {
        return $this->hasMany(WishList::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
}
