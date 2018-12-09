<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserApi extends Controller
{
    public function show($id)
    {
        return User::with('orders', 'orders.state', 'orders.address', 'orders.products')->find($id);
    }

}
