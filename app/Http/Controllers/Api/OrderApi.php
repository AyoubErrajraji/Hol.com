<?php

namespace App\Http\Controllers\Api;


use App\User;
use App\CartItem;
use App\Cart;
use App\Order;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class OrderApi extends Controller
{

    public function store(Request $request)
    {

        $products = Cart::Request();

        // iterate through the products and store them into the database
        foreach($products as $product){
            Cart::Request();([
                'product_id' => $product->id,
                'user_id' => auth()->id(),

            ]);

        }

        return back();


    }
}


