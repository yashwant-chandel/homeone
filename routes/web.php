<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authentication\AuthenticationController;
use App\Http\Controllers\Admin\AdminDashController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Front\FrontController;

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
Route::get('/register',[AuthenticationController::class,'register']);
Route::post('/registerProcc',[AuthenticationController::class,'registerProcc']);
Route::post('/loginprocc',[AuthenticationController::class,'loginProcc']);
Route::get('/logout',[AuthenticationController::class,'logout']);


//admin
Route::group(['middleware' =>['admin']],function(){
Route::get('/admin-dashboard',[AdminDashController::class,'index']);
Route::get('admin-dashboard/employerequests',[UserController::class,'index']);
Route::get('admin-dashboard/employeeslist',[UserController::class,'list']);
Route::post('employestatus',[UserController::class,'employestatus']);

//products
Route::get('admin-dashboard/category',[ProductController::class,'category']);
Route::post('admin-dashboard/categoriesadd',[ProductController::class,'addCategory']);


});

Route::get('/',[FrontController::class,'index']);
Route::get('/contact',[FrontController::class,'contact']);
Route::get('/lawn',[FrontController::class,'lawn']);
Route::get('/exteriors',[FrontController::class,'exteriors']);


