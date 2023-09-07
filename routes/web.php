<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authentication\AuthenticationController;
use App\Http\Controllers\Admin\AdminDashController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Front\ShopController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;


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



Route::get('/login',[AuthenticationController::class,'index']);
// Route::get('/register',[AuthenticationController::class,'register']);
// Route::post('/registerProcc',[AuthenticationController::class,'registerProcc']);
Route::post('/loginprocc',[AuthenticationController::class,'loginProcc']);
Route::get('/userloginprocc',[AuthenticationController::class,'userloginProcc']);
Route::get('/logout',[AuthenticationController::class,'logout']);


//admin
Route::group(['middleware' =>['admin']],function(){
Route::get('/admin-dashboard',[AdminDashController::class,'index'])->name('admin-dashboard');
Route::get('admin-dashboard/employeregister/',[UserController::class,'index'])->name('Employe-register');
Route::get('admin-dashboard/employeeslist',[UserController::class,'list'])->name('Employe-list');
Route::get('admin-dashboard/deleteemploye/{id}',[UserController::class,'delete']);
Route::post('registerProcc',[UserController::class,'registerProcc']);

//products
Route::get('admin-dashboard/category',[ProductController::class,'category'])->name('category');
Route::post('admin-dashboard/categoriesadd',[ProductController::class,'addCategory'])->name('category-add');
Route::post('catgoriesdelete',[ProductController::class,'deleteCategory']);

Route::get('admin-dashboard/productsAdd',[ProductController::class,'addProductsView'])->name('products-add');
Route::post('productsAdd',[ProductController::class,'addProduct']);
Route::get('admin-dashboard/products',[ProductController::class,'products'])->name('products');

Route::get('admin-dashboard/product-edit/{slug}',[ProductController::class,'editProduct'])->name('product-edit');
Route::post('productsUpdate',[ProductController::class,'productsUpdate']);
Route::get('product-remove/{slug}',[ProductController::class,'removeProduct']);


// GalleryController :
Route::get('admin-dashboard/gallery-add',[GalleryController::class,'addGalleryView'])->name('gallery-add');
Route::post('galleryAdd',[GalleryController::class,'addGallery']);

Route::get('admin-dashboard/gallery',[GalleryController::class,'index'])->name('gallery');
Route::get('admin-dashboard/gallery-edit/{slug}',[GalleryController::class,'editGallery'])->name('gallery-edit');
Route::post('galleryUpdate',[GalleryController::class,'galleryUpdate']);
Route::get('gallery-remove/{slug}',[GalleryController::class,'removeGallery']);


});




// Front controller start from here :
Route::get('/',[FrontController::class,'index']);
Route::get('/contact',[FrontController::class,'contact']);
Route::get('/lawn',[FrontController::class,'lawn']);
Route::get('/exteriors',[FrontController::class,'exteriors']);



// Route::get('/shop',[FrontController::class,'shop']);
Route::get('/gallery',[FrontController::class,'gallery']);

Route::group(['middleware' =>['user']],function(){
    // Route::get('/shop',[FrontController::class,'shop']);
    Route::get('/store',[ShopController::class,'index']);
    Route::get('/store-details/{slug}',[ShopController::class,'details']);

// Add To cart
Route::post('addToCart',[CartController::class,'addToCart']);
Route::get('cart',[CartController::class,'index']);
Route::post('update-cart',[CartController::class,'update']);
Route::post('remove-cart',[CartController::class,'removeCart']);

Route::get('checkout',[CheckoutController::class,'index']);

Route::post('checkoutpayment',[CheckoutController::class,'checkout']);
});



