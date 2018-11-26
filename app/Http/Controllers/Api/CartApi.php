<?php

namespace App\Http\Controllers\Api;

use App\CartItem;
use App\Category;
use App\Http\Controllers\Controller;
use App\Cart;
use App\product;
use Illuminate\Http\Request;


class CartApi extends Controller
{
    public function store(Request $request)
    {
        // iterate through the products and store them into the database
            CartItem::create()([
                'product_id' => $request->id,
                'cart_id' => $request->id(),
            ]);
        return back();
    }
}