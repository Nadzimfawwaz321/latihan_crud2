<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserProdukController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

// Redirect awal
Route::get('/', fn() => redirect()->route('user.produk.index'));

// Admin
Route::resource('produk', ProdukController::class);

// Pengguna
Route::get('/produk-user', [UserProdukController::class, 'index'])->name('user.produk.index');
Route::get('/produk-user/{id}', [UserProdukController::class, 'show'])->name('user.produk.show');

// Keranjang
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success/{id}', [CheckoutController::class, 'success'])->name('checkout.success');
