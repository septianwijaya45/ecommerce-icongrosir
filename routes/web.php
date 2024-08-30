<?php

use App\Http\Controllers\Master\CategoryController;
use App\Http\Controllers\Master\ProductController;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\Pages\ContactController;
use App\Http\Controllers\Pages\ProductAllController;
use App\Http\Controllers\Pages\ProductDetailController;
use App\Http\Controllers\Auth\AuthUserController;
use App\Http\Controllers\Auth\ConfirmOtpLogin;
use App\Http\Controllers\Auth\AccountController;
use App\Http\Controllers\Transaction\WishlistController;
use App\Http\Controllers\Transaction\MyCartController;
use App\Http\Controllers\Transaction\GetDetailProductController;
use App\Http\Controllers\Transaction\CheckoutController;
use App\Http\Controllers\Transaction\PesananSayaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('home', [HomeController::class, 'index'])->name('home');

// Authentication
Route::post('login', [AuthUserController::class, 'loginUser'])->name('login');
Route::get('logout', [AuthUserController::class, 'logout'])->name('logout');

Route::post('get-confirm-otp', [ConfirmOtpLogin::class, 'index'])->name('getConfirmOtp');
// login
// register
Route::get('register', [AuthUserController::class, 'register'])->name('register');
Route::post('store', [AuthUserController::class, 'store'])->name('register.store');
// otp
Route::get('confirm-otp', [AuthUserController::class, 'confirmOtp'])->name('confirm-otp');
Route::post('check-confirm-otp', [AuthUserController::class, 'checkConfirmOtp'])->name('checkConfirmOtp');
Route::get('resend-otp/{id}', [AuthUserController::class, 'resendOtp'])->name('resendOtp');

Route::group(['prefix' => 'Category'], function(){
    Route::get('get-five-category', [CategoryController::class, 'getFiveCategories'])->name('getFiveCategories');
    Route::get('get-three-category', [CategoryController::class, 'getThreeCategories'])->name('getThreeCategories');
});

Route::group(['prefix' => 'Product'], function(){
    Route::get('/all-product', [ProductAllController::class, 'index'])->name('products');
    Route::get('/product/{categoryId}', [ProductController::class, 'getProduct'])->name('product');
    Route::get('/get-eight-product-by-category/{categoryId}', [ProductController::class, 'getEightProductByCategories'])->name('getEightProductByCategories');
    Route::get('/get-product-popular', [ProductController::class, 'getProductPopular'])->name('getProductPopular');
    Route::get('/get-product-featured', [ProductController::class, 'getProductFeatured'])->name('getProductFeatured');
    Route::get('/get-product-latest', [ProductController::class, 'getProductLatest'])->name('getProductLatest');

    Route::get('/Detail-Product/{id}', [ProductDetailController::class, 'getProductById'])->name('getProductById');
    Route::get('/Warna-Product/{product_id}/{variant}/{wishlish}', [GetDetailProductController::class, 'getWarnaProduct'])->name('getWarnaProduct');
    Route::get('/Ukuran-Product/{product_id}/{variant}/{warna}/{wishlish}', [GetDetailProductController::class, 'getUkuranProduct'])->name('getUkuranProduct');
    Route::get('/Harga-Product/{product_id}/{variant}/{warna}/{ukuran}/{wishlish}', [GetDetailProductController::class, 'getHargaProduct'])->name('getHargaProduct');
});

Route::group(['prefix' => 'wishlish'], function(){
    Route::get('/wishlist-saya', [WishlistController::class, 'index'])->name('wishlist');
    Route::get('/create/{id}', [WishlistController::class, 'createWishlist'])->name('wishlist.store');
    Route::get('/update/{product_id}/{variant}/{warna}/{ukuran}/{wishlish}/{qty}', [WishlistController::class, 'updateWishlist'])->name('wishlist.update');
    Route::get('/delete/{id}', [WishlistController::class, 'deleteWishlist'])->name('wishlist.delete');
});

Route::group(['prefix' => 'cart'], function(){
    Route::get('/cart-saya', [MyCartController::class, 'index'])->name('cart');
    Route::get('/cart-saya/tambah/{id}/{uuid}/{variant_id}', [MyCartController::class, 'store'])->name('cart.store');
    Route::get('/cart-saya/tambah-cart-product/{id}', [MyCartController::class, 'storeCartById'])->name('cart.storeCartById');
    Route::post('/cart-saya/update/{id}/{uuid}/{variant_id}', [MyCartController::class, 'updateQty'])->name('cart.update');
    Route::get('/cart-saya/delete/{id}', [MyCartController::class, 'delete'])->name('cart.delete');

    Route::get('/Warna-Product/{product_id}/{variant}/{wishlish}', [MyCartController::class, 'getWarnaProduct'])->name('cart.warna');
    Route::get('/Ukuran-Product/{product_id}/{variant}/{warna}/{wishlish}', [MyCartController::class, 'getUkuranProduct'])->name('cart.ukuran');
    Route::get('/Harga-Product/{product_id}/{variant}/{warna}/{ukuran}/{wishlish}', [MyCartController::class, 'getHargaProduct'])->name('cart.harga');
});

Route::group(['prefix' => 'checkout'], function(){
    Route::get('/checkout-saya', [CheckoutController::class, 'index'])->name('checkout');
    Route::get('/checkout-saya/simpan', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::post('/checkout-saya/confirm', [CheckoutController::class, 'storeConfirm'])->name('checkout.confirm');
});

Route::group(['prefix' => 'account-me'], function(){
    Route::get('/my-profile', [AccountController::class, 'index'])->name('account');
    Route::post('/my-profile/save', [AccountController::class, 'update'])->name('accountSave');
});

Route::group(['prefix' => 'pesanan-saya'], function(){
    Route::get('/', [PesananSayaController::class, 'index'])->name('pesananSaya');
});

Route::get('contact-us', [ContactController::class, 'index'])->name('contactus');
