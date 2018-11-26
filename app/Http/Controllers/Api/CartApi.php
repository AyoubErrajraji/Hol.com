<?php

namespace App\Http\Controllers\Api;

use App\CartItem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class CartApi extends Controller
{
    public function store(Request $request)
    {

        $cartItem = new CartItem();
        $cartItem->product_id = $request->productId;
        $cartItem->cart_id = $request->cartId;

        $cartItem->save();

        return back();
    }
}