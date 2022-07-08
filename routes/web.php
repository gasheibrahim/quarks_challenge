<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Checkout;
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
    $products = Product::all();
    return view('welcome', compact('products'));
});


Route::get('/buy/{id}', [App\Http\Controllers\HomeController::class, 'show'])->name('buy');
Route::post('/addcart/{id}', [App\Http\Controllers\HomeController::class, 'addcart']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('products', ProductController::class);
Route::get('carts', [App\Http\Controllers\CartController::class, 'index'])->name('carts.index');
Route::resource('checkouts', CheckoutController::class);
