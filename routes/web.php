<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🏠 Home Page
Route::get('/', [PageController::class, 'home'])->name('home');

// 🧴 Products
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// ✅ Product Review Submission
Route::post('/product/{id}/review', [ProductController::class, 'addReview'])->name('product.review');

// 🛒 Cart
Route::get('/cart', [CartController::class, 'view'])->name('cart.view');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// 🌸 Know Your Skin Type
Route::get('/skin-type', function () {
    return view('pages.skin-type');
})->name('skin-type');
// 📞 Contact Page
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'sendContact'])->name('contact.send');
