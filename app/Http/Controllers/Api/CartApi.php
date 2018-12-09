<?php

namespace App\Http\Controllers\Api;

use App\CartItem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;




class CartApi extends Controller
{
    public function index () {
        return CartItem::with('product', 'cart')->get();
    }

    public function store(Request $request)
    {

        $cartItem = new CartItem();
        $cartItem->product_id = $request->productId;
        $cartItem->cart_id = $request->cartId;

        $cartItem->save();

        return $cartItem;
    }

    public function delete($id)
    {

        $cartItem = CartItem::find($id);

        $cartItem->delete();

        return back();
    }

    public function show($id)
    {
        return Cart::with('product')->find($id);
    }

}