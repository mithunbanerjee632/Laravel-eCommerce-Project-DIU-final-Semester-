<?php

use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CategoryModelController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\DetailsController;
use App\Http\Controllers\Frontend\DistrictController;
use App\Http\Controllers\Frontend\DivisionController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Frontend\PrivacyPolicyController;
use App\Http\Controllers\Frontend\RegisterController;
use App\Http\Controllers\Frontend\ReturnPolicyController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\TermsConditionController;
use App\Http\Controllers\Frontend\UserController;
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

//Checkouts
Route::group(['prefix'=>'checkouts'],function(){
    Route::get('/',[CheckoutController::class,'CheckoutPage'])->name('checkouts');
    Route::get('/form',[CheckoutController::class,'CheckoutForm'])->name('checkouts.form');
    Route::post('/store',[CheckoutController::class,'CheckoutStore'])->name('checkouts.store');
});

//Users

Route::group(['prefix'=>'users'],function(){

    Route::get('/dashboard',[UserController::class,'UserDashboard'])->name('users.dashboard');
    Route::get('/Profile',[UserController::class,'UserProfile'])->name('users.profile');
    Route::post('/Profile/update',[UserController::class,'UserProfileUpdate'])->name('users.profile.update');

});


//Division Routes
Route::group(['prefix'=>'/divisions'],function(){
    Route::get('/', [DivisionController::class,'index'])->name('admin.divisions');
    Route::get('/create', [DivisionController::class,'create'])->name('admin.divisions.create');
    Route::get('/edit/{id}', [DivisionController::class,'edit'])->name('admin.divisions.edit');
    Route::get('/store', [DivisionController::class,'store'])->name('admin.divisions.store');
    Route::get('/division/edit/{id}', [DivisionController::class,'update'])->name('admin.divisions.update');
    Route::get('/division/delete/{id}', [DivisionController::class,'delete'])->name('admin.divisions.delete');
});



//District Routes
Route::group(['prefix'=>'/districts'],function(){
    Route::get('/', [DistrictController::class,'index'])->name('admin.district');
    Route::get('/create', [DistrictController::class,'create'])->name('admin.district.create');
    Route::get('/edit/{id}', [DistrictController::class,'edit'])->name('admin.district.edit');
    Route::get('/store', [DistrictController::class,'store'])->name('admin.district.store');
    Route::get('/district/edit/{id}', [DistrictController::class,'update'])->name('admin.district.update');
    Route::get('/district/delete/{id}', [DistrictController::class,'delete'])->name('admin.district.delete');
});
