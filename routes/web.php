<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;

// Home Page Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Category Route
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');

// Product Details Route
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// Authentication Routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
     ->middleware('guest')
     ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
     ->middleware('guest');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
     ->middleware('auth')
     ->name('logout');

Route::get('/register', [RegisteredUserController::class, 'create'])
     ->middleware('guest')
     ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
     ->middleware('guest');

// Cart Management Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/delete-cart-item/{id}', [CartController::class, 'deleteCartItem'])->name('delete.cart.item');

// Order Routes
Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('place.order');
Route::get('/order-success', [OrderController::class, 'orderSuccess'])->name('order.success');

// Shipment Info Route
Route::get('/shipment-info', [OrderController::class, 'showShipmentInfo'])->name('shipment.info');

// Profile Management Routes (ensure uniqueness and no duplicates)
Route::middleware(['auth'])->group(function () {
    Route::get('/user/profile', [ProfileController::class, 'show'])->name('user.profile');
    Route::get('/user/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/user/profile/update', [ProfileController::class, 'update'])->name('profile.update');  // Unique route for update
    Route::delete('/user/profile/delete', [ProfileController::class, 'delete'])->name('profile.delete');  // Corrected deletion route
    Route::post('/user/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rating Route
Route::post('/submit-rating', [RatingController::class, 'submitRating'])
     ->middleware('auth')  // Only authenticated users can submit ratings
     ->name('submit.rating');

Route::post('/order/buy', [OrderController::class, 'buyNow'])->name('order.buy');

// Authentication Routes
require __DIR__.'/auth.php';
