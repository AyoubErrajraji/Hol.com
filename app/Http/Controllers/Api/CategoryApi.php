<?php

namespace App\Http\Controllers\Api;


use App\Category;
use App\Http\Controllers\Controller;

class CategoryApi extends Controller
{
    public function index($orderBy, $order = 'asc')
    {
        return Category::with('products')->orderBy($orderBy, $order)->get();
    }

    public function show($id)
    {
        return Category::with('products')->find($id);

    }
    public function showOrder($id, $orderBy, $order = 'asc')
    {
        return Category::find($id)->products()->orderBy($orderBy, $order)->get();

    }


//    public function show1($name){
//        return Category::with('products')->find($name);
//    }
}
