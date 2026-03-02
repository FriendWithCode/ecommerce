<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProdukCon;
use App\Http\Controllers\PembelianCon;
use App\Http\Controllers\RegisterCon;
use App\Http\Controllers\KeranjangCon;


Route::get('/', [ProdukCon::class, 'home'])->name('homeproduk');


Route::post('/pembelian/storeinput', [PembelianCon::class, 'storeinput'])
    ->name('storeInputpembelian')
    ->middleware('auth');

// Cart routes
Route::middleware('auth')->group(function () {
    Route::post('/cart/add', [KeranjangCon::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update', [KeranjangCon::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [KeranjangCon::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/cart/data', [KeranjangCon::class, 'getCart'])->name('cart.data');
    Route::post('/cart/checkout', [KeranjangCon::class, 'checkout'])->name('cart.checkout');
});

// Register user
Route::get('/register', [RegisterCon::class, 'register'])->name('register');
Route::post('/register/action', [RegisterCon::class, 'actionregister'])->name('actionregister');

// Logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');