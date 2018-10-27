<?php

namespace App\Http\Controllers\Api;

use App\Bid;
use App\Ad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdApi extends Controller
{
    public function index()
    {
        return Ad::with('user', 'type', 'state', 'bid.user')
            ->where('state_id', 4)
            ->get();
    }

    public function show($id)
    {
        return Ad::with('user', 'type', 'state','bid.user')->find($id);
    }

}
