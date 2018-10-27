<?php

namespace App\Http\Controllers\Api;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductApi extends Controller
{
    public function index()
    {
        return Product::with('user')->get();
    }

    public function show($id)
    {
        return Product::with('user')->find($id);
    }
}
