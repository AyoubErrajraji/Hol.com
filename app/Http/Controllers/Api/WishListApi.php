<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\WishListItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WishListApi extends Controller
{
    public function show($id)
    {
        return User::with('wishlist')->find($id);
    }

    public function store(Request $request)
    {
        $WishListItem = WishListItem::create($request->all());
        return response()->json($WishListItem, 201);
    }

    public function delete($id)
    {
        $WishListItem = WishListItem::find($id);
        $WishListItem->delete();

        return response()->json(null, 204);
    }
}
