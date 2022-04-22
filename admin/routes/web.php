<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;


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
Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
Route::get('/', [HomeController::class,'HomeIndex']);




//Products Management
Route::get('/products', [ProductController::class,'ProductIndex']);
Route::get('/getProductsData', [ProductController::class,'ProductsData']);
Route::post('/ProductAdd', [ProductController::class,'ProductAdd']);
Route::post('/PorductDetails', [ProductController::class,'ProductDetails']);
Route::post('/UpdateProductDetails', [ProductController::class,'UpdateProduct']);
Route::post('/ProductDelete', [ProductController::class,'DeleteProduct']);

//Category Management System

Route::get('/category', [CategoryController::class,'CategoryIndex']);
Route::get('/getCategoryData', [CategoryController::class,'CategoryData']);
Route::post('/AddCategory', [CategoryController::class,'CategoryAdd']);
Route::post('/getCategoryDetails', [CategoryController::class,'CategoryDetails']);
Route::post('/CategoryUpdate', [CategoryController::class,'CategoryUpdate']);
Route::post('/DeleteCategory', [CategoryController::class,'CategoryDelete']);

