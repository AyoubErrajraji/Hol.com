<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;

class CategoryApi extends Controller
{
    public function index()
    {
        return Category::with('products')->get();
    }

    public function show($id)
    {
        return Category::with('products')->find($id);

    }
}
