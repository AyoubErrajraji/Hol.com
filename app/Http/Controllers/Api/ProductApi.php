<?php

namespace App\Http\Controllers\Api;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductApi extends Controller
{
    public function index()
    {
        return Product::with('user', 'reviews', 'categories')->where('active', 1)->get();
    }

    public function show($id)
    {
        return Product::with('user', 'reviews', 'categories')->find($id);
    }

}
