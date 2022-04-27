<?php

use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CategoryModelController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\DetailsController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Frontend\PrivacyPolicyController;
use App\Http\Controllers\Frontend\RegisterController;
use App\Http\Controllers\Frontend\ReturnPolicyController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\TermsConditionController;
use Illuminate\Support\Facades\Route;


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
    return view('welcome');
});
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

/*Route::get('/ShopPage',[ShopController::class,'ShopPage'])->middleware(['auth']);*/

require __DIR__.'/auth.php';






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
//error logs
Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);


//pages
Route::get('/',[HomeController::class,'HomePage']);

Route::get('/RegistrationPage',[RegisterController::class,'RegistrationPage']);
Route::get('/LoginPage',[LoginController::class,'LoginPage']);


Route::get('/CheckoutPage',[CheckoutController::class,'CheckoutPage']);
Route::get('/ReturnPolicyPage',[ReturnPolicyController::class,'ReturnPolicyPage']);
Route::get('/ContactPage',[ContactController::class,'ContactPage']);
Route::get('/AboutPage',[AboutController::class,'AboutPage']);
Route::get('/PrivacyPage',[PrivacyPolicyController::class,'PrivacyPage']);
Route::get('/TermsConditionPage',[TermsConditionController::class,'TermsConditionPage']);

//Products
Route::get('/ProductDetails/{slug}',[DetailsController::class,'ProductDetails']);
Route::get('/ShopPage',[ShopController::class,'ShopPage']);
Route::get('/DetailsPage',[DetailsController::class,'DetailsPage']);

//Search Products
Route::get('/search',[ShopController::class,'Search'])->name('search');

//category
/*Route::get('/categories',[CategoryModelController::class,'Category']);*/
Route::get('/allCategories/{id}',[CategoryModelController::class,'ProductByCategories'])->name('categories.product');


//carts
Route::get('/CartPage',[CartController::class,'CartPage']);
Route::post('/carts/store',[CartController::class,'CartStore'])->name('carts.store');
Route::post('/carts/update/{id}',[CartController::class,'CartUpdate'])->name('carts.update');
Route::post('/carts/delete/{id}',[CartController::class,'CartDelete'])->name('carts.delete');
