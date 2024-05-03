<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/',[HomeController::class, 'index']);
Route::get('/product/details/',[HomeController::class, 'productDetails']);
Route::get('/product/view-cart',[HomeController::class, 'viewCart']);
Route::get('/product/check-out',[HomeController::class, 'productCheckout']);
Route::get('/shop-products',[HomeController::class, 'shopProduct']);
Route::get('/return-product',[HomeController::class, 'returnProduct']);
Route::get('/privacy-policy',[HomeController::class, 'privacyPolicy']);

Auth::routes();

Route::get('/admin/login',[AdminController::class, 'login']);
Route::post('/admin/login-access',[AdminController::class, 'loginCheck']);

Route::get('/admin/dashboard', [AdminController::class,'dashboard']);

//Category Route
Route::get('/admin/category/list',[CategoryController::class, 'showCategory']);
Route::get('/admin/category/create',[CategoryController::class, 'createCategory']);
Route::post('/admin/category/store',[CategoryController::class, 'storeCategory']);
Route::get('/admin/category/delete/{id}',[CategoryController::class, 'deleteCategory']);