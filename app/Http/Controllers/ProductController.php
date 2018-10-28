<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    use Authorizable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Product::with('user')->get();
        return view('product.index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:10',
            'body' => 'required|min:20'
        ]);

        $request->user()->products()->create($request->all());

        flash('Product has been added');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $product = Product::findOrFail($product->id);

        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'title' => 'required|min:10',
            'body' => 'required|min:20'
        ]);

        $me = $request->user();

        if( $me->hasRole('Admin') ) {
            $product = Product::findOrFail($product->id);
        } else {
            $product = $me->products()->findOrFail($product->id);
        }

        $product->update($request->all());

        flash()->success('Product has been updated.');

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $me = Auth::user();

        if( $me->hasRole('Admin') ) {
            $product = Product::findOrFail($product->id);
        } else {
            $product = $me->products()->findOrFail($product->id);
        }

        $product->delete();

        flash()->success('Product has been deleted.');

        return redirect()->route('products.index');
    }
}
