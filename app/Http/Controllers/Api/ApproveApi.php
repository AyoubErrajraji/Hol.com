<?php

namespace App\Http\Controllers\Api;

use App\Ad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApproveApi extends Controller
{
    public function index()
    {
        return Ad::where('state_id', 3)->get();
    }
}
