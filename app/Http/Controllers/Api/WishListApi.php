<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\WishList;
use App\WishListItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WishListApi extends Controller
{
    public function index () {
        return WishListItem::with('wishlistitems','wishlist')->get();
    }
    public function store(Request $request)
    {
        $wishlistitem = new WishlistItem();
        $wishlistitem->product_id = $request->productId;
        $wishlistitem->wishlist_id = $request->wishlistId;

        $wishlistitem->save();

        return $wishlistitem;
    }

    public function delete($id)
    {
        $wishlistitem = WishListItem::find($id);
        $wishlistitem->delete();

        return response()->json(null, 204);
    }

    public function show($id)
    {
        return User::with('wishlistitems', 'wishlistitems.product')->find($id);
    }
}
