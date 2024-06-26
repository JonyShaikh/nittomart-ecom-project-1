<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SubCategoryController;

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
Route::get('/product/details/{slug}',[HomeController::class, 'productDetails']);
Route::get('/product/view-cart',[HomeController::class, 'viewCart']);
Route::get('/product/check-out',[HomeController::class, 'productCheckout']);
Route::get('/shop-products',[HomeController::class, 'shopProduct']);
Route::get('/return-product',[HomeController::class, 'returnProduct']);
Route::get('/privacy-policy',[HomeController::class, 'privacyPolicy']);

//Add to Cart Routes...
Route::post('/product/addtocart-details/{id}',[HomeController::class,'addtoCartDetails']);
Route::get('/product/addtocart/{id}',[HomeController::class,'addtoCart']);

Auth::routes();

Route::get('/admin/login',[AdminController::class, 'login']);
Route::post('/admin/login-access',[AdminController::class, 'loginCheck']);

Route::get('/admin/dashboard', [AdminController::class,'dashboard']);

//Category Route
Route::get('/admin/category/list',[CategoryController::class, 'showCategory']);
Route::get('/admin/category/create',[CategoryController::class, 'createCategory']);
Route::post('/admin/category/store',[CategoryController::class, 'storeCategory']);
Route::get('/admin/category/delete/{id}',[CategoryController::class, 'deleteCategory']);
Route::get('/admin/category/edit/{id}',[CategoryController::class, 'editCategory']);
Route::post('/admin/category/update/{id}',[CategoryController::class, 'updateCategory']);


//Sub-Category Route
Route::get('/admin/sub-category/list',[SubCategoryController::class, 'showSubCategory']);
Route::get('/admin/sub-category/create',[SubCategoryController::class, 'createSubCategory']);
Route::post('/admin/sub-category/store',[SubCategoryController::class, 'storeSubCategory']);
Route::get('/admin/sub-category/delete/{id}',[SubCategoryController::class, 'deleteSubCategory']);
Route::get('/admin/sub-category/edit/{id}',[SubCategoryController::class, 'editSubCategory']);
Route::post('/admin/sub-category/update/{id}',[SubCategoryController::class, 'updateSubCategory']);


//Products Route
Route::get('/admin/product/list',[ProductController::class, 'showProduct']);
Route::get('/admin/product/create',[ProductController::class, 'createProduct']);
Route::post('/admin/product/store',[ProductController::class, 'storeProduct']);
Route::get('/admin/product/delete/{id}',[ProductController::class, 'deleteProduct']);
Route::get('/admin/product/edit/{id}',[ProductController::class, 'editProduct']);
Route::post('/admin/product/update/{id}',[ProductController::class, 'updateProduct']);