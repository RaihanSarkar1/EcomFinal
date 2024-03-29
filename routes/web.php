<?php

use Illuminate\Support\Facades\Route;

use App\Product;
use App\Category;

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

Route::get('/', function () {
    $categories = Category::all();
    $products = Product::all();
    return view('index', compact('categories','products'));
});

Route::get('login', 'HomeController@index');
Route::post('login', 'HomeController@login');
Route::get('roles', 'HomeController@roles');
Route::get('logout', 'HomeController@logout');
Route::get('home', 'HomeController@viewHome')->middleware('isLoggedIn');
Route::get('change_password', 'HomeController@viewChangePassword')->middleware('isLoggedIn');
Route::post('change_password', 'HomeController@changePassword')->middleware('isLoggedIn');

// Admin View
Route::get('admin', 'HomeController@viewAdmin')->middleware('isLoggedIn','isAdmin');
Route::get('add_user', 'UserController@addView')->middleware('isLoggedIn','isAdmin');
Route::get('users', 'UserController@index')->middleware('isLoggedIn','isAdmin');
Route::get('user/edit/{id}', 'UserController@edit')->middleware('isLoggedIn','isAdmin');
Route::post('user/update/{id}', 'UserController@update')->middleware('isLoggedIn','isAdmin');
Route::post('add_user', 'UserController@store')->middleware('isLoggedIn','isAdmin');
Route::post('check_email', 'UserController@checkEmail')->middleware('isLoggedIn','isAdmin');


Route::get('manage_categories', 'CategoryController@manageCategories')->middleware('isLoggedIn','isAdmin');
Route::post('add_category', 'CategoryController@addCategory')->middleware('isLoggedIn','isAdmin');
Route::get('category/delete/{id}', 'CategoryController@deleteCategory')->middleware('isLoggedIn','isAdmin');
Route::get('category/edit/{id}', 'CategoryController@editCategory')->middleware('isLoggedIn','isAdmin');
Route::post('category/edit/{id}', 'CategoryController@updateCategory')->middleware('isLoggedIn','isAdmin');


Route::get('add_product', 'ProductController@addProduct')->middleware('isLoggedIn','isAdmin');
Route::post('add_product', 'ProductController@createProduct')->middleware('isLoggedIn','isAdmin');
Route::get('view_products', 'ProductController@viewProducts')->middleware('isLoggedIn','isAdmin');
Route::get('product/delete/{id}', 'ProductController@deleteProduct')->middleware('isLoggedIn','isAdmin');
Route::get('product/edit/{id}', 'ProductController@editProduct')->middleware('isLoggedIn','isAdmin');
Route::post('product/edit/{id}', 'ProductController@updateProduct')->middleware('isLoggedIn','isAdmin');

Route::get('manage_orders', 'OrderController@manageOrders')->middleware('isLoggedIn','isAdmin');
Route::get('order/approve/{id}', 'OrderController@approve')->middleware('isLoggedIn','isAdmin');
Route::get('order/deliver/{id}', 'OrderController@deliver')->middleware('isLoggedIn','isAdmin');
Route::get('order/cancel/{id}', 'OrderController@cancel')->middleware('isLoggedIn','isAdmin');


// Customer View
Route::post('register_user', 'UserController@registerUser');
Route::get('customer_view_product', 'CustomerController@viewProducts')->middleware('isLoggedIn');


// Geust view
Route::get('my_account', 'CustomerController@myAccount')->middleware('isLoggedIn');
Route::get('product/{code}', 'HomeController@product_details');
Route::get('addToCart/{id}', 'CustomerController@addToCart');
Route::get('cart', 'CustomerController@cart');
Route::get('cart/update', 'CustomerController@updateCart');
Route::get('remove/{id}', 'CustomerController@remove');
Route::get('category_view/{id}', 'HomeController@category');
Route::get('category', 'HomeController@shop');
Route::patch('cart/updateQuantity', 'CustomerController@updateCartQuantity');
Route::get('user_order/{id}', 'OrderController@viewUserOrder')->middleware('isLoggedIn');

Route::post('user_update/{id}', 'UserController@updateUser')->middleware('isLoggedIn');



Route::get('category/{id}', 'CustomerController@category');
Route::get('categories', 'CustomerController@categories')->middleware('isLoggedIn');


Route::post('checkout', 'CustomerController@placeOrder')->middleware('isLoggedIn');
Route::get('checkout', 'CustomerController@checkout')->middleware('isLoggedIn');

Route::get('my_orders', 'OrderController@myOrders')->middleware('isLoggedIn');

// admin
Route::get('order/{id}', 'OrderController@viewOrder')->middleware('isLoggedIn');
