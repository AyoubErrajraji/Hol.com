<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\ShoppingCartItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShoppingCartApi extends Controller
{
    public function show($id)
    {
        return User::with('shoppingcart')->find($id);
    }

    public function store(Request $request)
    {
        $ShoppingCartItem = ShoppingCartItem::create($request->all());
        return response()->json($ShoppingCartItem, 201);
    }

    public function delete($id)
    {
        $ShoppingCartItem = ShoppingCartItem::find($id);
        $ShoppingCartItem->delete();

        return response()->json(null, 204);
    }
}