<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/',[App\Http\Controllers\Product_imageController::class, 'home'] )->name('trangchu');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/homead', [App\Http\Controllers\Auth\RegisterController::class, 'home'])->name('homead');

Route::get('/indexUser', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('indexUser');
//Category
Route::get('/showCate', [App\Http\Controllers\CategoryController::class, 'index'])->name('showCate');
Route::get('/addCate', [App\Http\Controllers\CategoryController::class, 'create'])->name('addCate');
Route::post('/addCategory', [App\Http\Controllers\CategoryController::class, 'store'])->name('addCategory');
Route::get('/editCate/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('editCate');
Route::post('/updateCate/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('updateCate');
Route::get('/destroyCate/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('destroyCate');
Route::post('/activeCategory', [App\Http\Controllers\CategoryController::class, 'active'])->name('activeCategory');

//brands
Route::get('/showBrand', [App\Http\Controllers\BrandController::class, 'index'])->name('showBrand');
Route::get('/createBrand', [App\Http\Controllers\BrandController::class, 'create'])->name('createBrand');
Route::post('/storeBrand', [App\Http\Controllers\BrandController::class, 'store'])->name('storeBrand');
Route::get('/editBrand/{id}', [App\Http\Controllers\BrandController::class, 'edit'])->name('editBrand');
Route::post('/updateBrand/{id}', [App\Http\Controllers\BrandController::class, 'update'])->name('updateBrand');
Route::get('/destroyBrand/{id}', [App\Http\Controllers\BrandController::class, 'destroy'])->name('destroyBrand');
Route::post('/activeBrand', [App\Http\Controllers\BrandController::class, 'active'])->name('activeBrand');

//banners
Route::get('/indexBanners', [App\Http\Controllers\BannerController::class, 'index'])->name('indexBanners');
Route::get('/createBanners', [App\Http\Controllers\BannerController::class, 'create'])->name('createBanners');
Route::post('/storeBanners', [App\Http\Controllers\BannerController::class, 'store'])->name('storeBanners');
Route::get('/editBanners/{id}', [App\Http\Controllers\BannerController::class, 'edit'])->name('editBanners');
Route::post('/updateBanners/{id}', [App\Http\Controllers\BannerController::class, 'update'])->name('updateBanners');
Route::get('/destroyBanners/{id}', [App\Http\Controllers\BannerController::class, 'destroy'])->name('destroyBanners');
Route::post('/activeBanner', [App\Http\Controllers\BannerController::class, 'active'])->name('activeBanner');
//product
Route::get('/indexProduct', [App\Http\Controllers\ProductController::class, 'index'])->name('indexProduct');
Route::get('/createProduct', [App\Http\Controllers\ProductController::class, 'create'])->name('createProduct');
Route::post('/storeProduct', [App\Http\Controllers\ProductController::class, 'store'])->name('storeProduct');
Route::get('/editProducts/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('editProducts');
Route::post('/updateProducts/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('updateProducts');
Route::get('/destroyProducts/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('destroyProducts');
Route::get('/showbyBrand/{id}', [App\Http\Controllers\ProductController::class, 'showbyBrand'])->name('showbyBrand');
Route::get('/showbyCate/{id}', [App\Http\Controllers\ProductController::class, 'showbyCate'])->name('showbyCate');
Route::get('/showProduct/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('showProduct');
Route::get('/shop', [App\Http\Controllers\ProductController::class, 'shop'])->name('shop');
Route::get('/showbyTag/{tag}', [App\Http\Controllers\ProductsController::class, 'showbyTags'])->name('showbyTag');
Route::get('/active', [App\Http\Controllers\ProductController::class, 'active'])->name('active');
Route::get('/search', [App\Http\Controllers\ProductController::class, 'search'])->name('search');
//image
Route::get('/showImage/{id}', [App\Http\Controllers\Product_imageController::class, 'show'])->name('showImage');
Route::get('/createImage/{id}', [App\Http\Controllers\Product_imageController::class, 'create'])->name('createImage');
Route::post('/storeImage', [App\Http\Controllers\Product_imageController::class, 'store'])->name('storeImage');
Route::get('/destroyImage/{id}/{idp}', [App\Http\Controllers\Product_imageController::class, 'destroy'])->name('destroyImage');


//cart
// Route::post('/addCart', [App\Http\Controllers\CartController::class, 'save_cart'])->name('addCart');
// Route::get('/showCart', [App\Http\Controllers\CartController::class, 'show_cart'])->name('showCart');
 Route::post('/storeCart', [App\Http\Controllers\CartController::class, 'store'])->name('storeCart');
 Route::get('/showCart/{id}', [App\Http\Controllers\CartController::class, 'show'])->name('showCart');
 Route::get('/cong/{id}', [App\Http\Controllers\CartController::class, 'cong'])->name('cong');
 Route::get('/tru/{id}', [App\Http\Controllers\CartController::class, 'tru'])->name('tru');
 Route::post('/updateCart/{id}', [App\Http\Controllers\CartController::class, 'update'])->name('updateCart');
 Route::get('/destroyCart/{id}', [App\Http\Controllers\CartController::class, 'destroy'])->name('destroyCart');

//Order
Route::post('/storeOrder', [App\Http\Controllers\OrderController::class, 'store'])->name('storeOrder');
Route::post('/select-delivery', [App\Http\Controllers\CartController::class, 'select_delivery'])->name('select-delivery');
Route::get('/indexOrder', [App\Http\Controllers\OrderController::class, 'index'])->name('indexOrder');
Route::get('/updateOrder/{id}', [App\Http\Controllers\OrderController::class, 'update'])->name('updateOrder');

//Comment
Route::post('/storeComment', [App\Http\Controllers\CommentController::class, 'store'])->name('storeComment');
Route::post('/updateComment', [App\Http\Controllers\CommentController::class, 'update'])->name('updateComment');