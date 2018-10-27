<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\WatchListItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WatchListApi extends Controller
{
    public function show($id)
    {
        return User::with('watchlist')->find($id);
    }

    public function store(Request $request)
    {
        $watchListItem = WatchListItem::create($request->all());
        return response()->json($watchListItem, 201);
    }

    public function delete($id)
    {
        $watchListItem = WatchListItem::find($id);
        $watchListItem->delete();

        return response()->json(null, 204);
    }
}
