<?php

namespace App\Http\Controllers\Api;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderApi extends Controller
{
    public function show($id)
    {
        return Order::with('payment', 'products', 'user', 'address')->find($id);
    }

}
