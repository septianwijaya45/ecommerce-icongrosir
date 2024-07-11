<?php

use App\Http\Controllers\Master\CategoryController;
use App\Http\Controllers\Master\ProductController;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\Pages\ProductDetailController;
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

Route::group(['prefix' => 'Category'], function(){
    Route::get('get-five-category', [CategoryController::class, 'getFiveCategories'])->name('getFiveCategories');
    Route::get('get-three-category', [CategoryController::class, 'getThreeCategories'])->name('getThreeCategories');
});

Route::group(['prefix' => 'Product'], function(){
    Route::get('/product/{categoryId}', [ProductController::class, 'getProduct'])->name('product');
    Route::get('/get-eight-product-by-category/{categoryId}', [ProductController::class, 'getEightProductByCategories'])->name('getEightProductByCategories');
    Route::get('/get-product-popular', [ProductController::class, 'getProductPopular'])->name('getProductPopular');
    Route::get('/get-product-featured', [ProductController::class, 'getProductFeatured'])->name('getProductFeatured');
    Route::get('/get-product-latest', [ProductController::class, 'getProductLatest'])->name('getProductLatest');

    Route::get('/Detail-Product/{id}', [ProductDetailController::class, 'getProductById'])->name('getProductById');
});