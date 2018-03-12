<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'FrontendController@products')->name('index');
Route::get('/subcategory/{slug}', 'FrontendController@subProducts')->name('sub.products');

Route::get('/cart', 'CartController@cart')->name('cart');
Route::get('/cart/{id}', 'CartController@add')->name('cart.add');
Route::get('/cart/decr/{id}', 'CartController@decr')->name('cart.decr');
Route::get('/cart/remove/{id}', 'CartController@remove')->name('cart.remove');
Route::get('/checkout', 'CartController@checkout')->name('cart.checkout');
Route::post('/checkout', 'CartController@postCheckout')->name('checkout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', function () {
    return view('admin.dashboard');
});
Route::get('/product/bin', 'ProductController@bin')->name('product.bin');
Route::get('/product/restore/{id}', 'ProductController@restore')->name('product.restore');
Route::get('/product/kill/{id}', 'ProductController@kill')->name('product.kill');


Route::resources([
	'product' => 'ProductController',
	'subcategory' => 'SubcategoryController',
	'category'	=> 'CategoryController',
	'order' => 'OrderController',
	'customer' => 'CustomerController'
]);
