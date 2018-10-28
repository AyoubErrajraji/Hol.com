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

Route::get('products', 'Api\ProductApi@index');
Route::get('product/{id}', 'Api\ProductApi@show');

Route::get('categories', 'Api\CategoryApi@index');
Route::get('category/{id}', 'Api\CategoryApi@show');

Route::get('settings/{id}', 'Api\SettingsApi@show');
Route::put('settings', 'Api\SettingsApi@update');