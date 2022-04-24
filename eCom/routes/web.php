<?php

use App\Http\Controllers\CategoryModelController;
use App\Http\Controllers\ReturnPolicyController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TermsConditionController;

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

/*Route::get('/', function () {
    return view('Home');
});*/

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);



Route::get('/',[HomeController::class,'HomePage']);
Route::get('/ShopPage',[ShopController::class,'ShopPage']);
Route::get('/RegistrationPage',[RegisterController::class,'RegistrationPage']);
Route::get('/LoginPage',[LoginController::class,'LoginPage']);
Route::get('/DetailsPage',[DetailsController::class,'DetailsPage']);
Route::get('/CartPage',[CartController::class,'CartPage']);
Route::get('/CheckoutPage',[CheckoutController::class,'CheckoutPage']);
Route::get('/ReturnPolicyPage',[ReturnPolicyController::class,'ReturnPolicyPage']);
Route::get('/ContactPage',[ContactController::class,'ContactPage']);
Route::get('/AboutPage',[AboutController::class,'AboutPage']);
Route::get('/PrivacyPage',[PrivacyPolicyController::class,'PrivacyPage']);
Route::get('/TermsConditionPage',[TermsConditionController::class,'TermsConditionPage']);

//Products
Route::get('/ProductDetails/{slug}',[DetailsController::class,'ProductDetails']);
//Search Products
Route::get('/search',[ShopController::class,'Search'])->name('search');

//category
/*Route::get('/categories',[CategoryModelController::class,'Category']);*/
/*Route::get('/allCategories',[ShopController::class,'AllCategories']);*/
