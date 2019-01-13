<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();


});

Route::get('products/{orderBy}/{order?}', 'Api\ProductApi@index');
Route::get('product/{id}', 'Api\ProductApi@show');

Route::get('payment/test', 'Api\PaymentApi@create');

Route::get('cartitem', 'Api\CartApi@index');
Route::get('cartitem/{id}', 'Api\CartApi@show');
Route::post('cartitem', 'Api\CartApi@store');
Route::delete('cartitem/{id}', 'Api\CartApi@delete');

Route::get('wishlistitem', 'Api\WishListApi@index');
Route::get('wishlistitem/{id}', 'Api\WishListApi@show');
Route::post('wishlistitem', 'Api\WishListApi@store');
Route::delete('wishlistitem/{id}', 'Api\WishListApi@delete');

Route::get('categories', 'Api\CategoryApi@index');
Route::get('category/{id}', 'Api\CategoryApi@show');

Route::get('settings/{id}', 'Api\SettingsApi@show');
Route::put('settings', 'Api\SettingsApi@update');

Route::get('user/{id}', 'Api\UserApi@show');

Route::get('order/{id}', 'Api\OrderApi@show');