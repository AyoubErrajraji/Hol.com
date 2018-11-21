<?php

namespace App\Http\Controllers\Api;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductApi extends Controller
{
    public function index($orderBy, $order = 'asc')
    {
        return Product::with('user', 'reviews', 'categories')->where('active', 1)->orderBy($orderBy, $order)->get();
    }

    public function show($id)
    {
        return Product::with('user', 'reviews', 'categories', 'categories.products')->find($id);
    }

}
