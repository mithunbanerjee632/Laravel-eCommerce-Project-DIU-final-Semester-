<?php


use Illuminate\Support\Facades\Route;
/*use App\Http\Controllers\Backend\DashboardController;*/
use App\Http\Controllers\Backend\AdminController;



use App\Http\Controllers\Backend\AdminDashboard;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DistrictControllers;
use App\Http\Controllers\Backend\DivisionControllers;
use App\Http\Controllers\Backend\OrdersController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\AdminUserController;


use App\Http\Controllers\Backend\ProductController;

use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CategoryModelController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\DetailsController;
use App\Http\Controllers\Frontend\DistrictController;
use App\Http\Controllers\Frontend\DivisionController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\HomeSlider;

use App\Http\Controllers\Frontend\PrivacyPolicyController;

use App\Http\Controllers\Frontend\ReturnPolicyController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\TermsConditionController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\WishlistController;

use App\Http\Controllers\Vendor\VendorController;
use App\Http\Controllers\Vendor\VendorDashboard;
use App\Http\Controllers\Vendor\VendorProduct;
use App\Http\Controllers\Vendor\VendorBrand;
use App\Http\Controllers\Vendor\VendorCategory;


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
});*/


Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';




//Users Routes
Route::group(['prefix'=>'users'],function(){

    Route::get('/dashboard',[UserController::class,'UserDashboard'])->name('users.dashboard');
    Route::get('/Profile',[UserController::class,'UserProfile'])->name('users.profile');
    Route::post('/Profile/update',[UserController::class,'UserProfileUpdate'])->name('users.profile.update');

});

//Frontend Routes

Route::get('/',[HomeController::class,'HomePage']);




Route::get('/ReturnPolicyPage',[ReturnPolicyController::class,'ReturnPolicyPage']);

Route::get('/AboutPage',[AboutController::class,'AboutPage']);
Route::get('/PrivacyPage',[PrivacyPolicyController::class,'PrivacyPage']);
Route::get('/TermsConditionPage',[TermsConditionController::class,'TermsConditionPage']);

//Products

Route::get('/ShopPage',[ShopController::class,'ShopPage']);

//Details
Route::get('/DetailsPage',[DetailsController::class,'DetailsPage']);
Route::get('/ProductDetails/{slug}/{title}',[DetailsController::class,'ProductDetails']);
//Search Products
Route::get('/search',[ShopController::class,'Search'])->name('search');

//category
/*Route::get('/categories',[CategoryModelController::class,'Category']);*/
Route::get('/allCategories/{id}',[CategoryModelController::class,'ProductByCategories'])->name('categories.product');


//carts Routes
Route::get('/CartPage',[CartController::class,'CartPage']);
Route::post('/carts/store',[CartController::class,'CartStore'])->name('carts.store');
Route::post('/carts/update/{id}',[CartController::class,'CartUpdate'])->name('carts.update');
Route::post('/carts/delete/{id}',[CartController::class,'CartDelete'])->name('carts.delete');

//WishList Routes

Route::post('/AddToWishlist',[WishlistController::class,'WishlistData']);
Route::post('wishlist/delete/{id}',[WishlistController::class,'WishlistDelete'])->name('wishlist.delete');
Route::group(['middleware'=>'auth'],function(){
    Route::get('/WishList',[WishlistController::class,'WishlistPage']);
});

//Checkouts
Route::group(['prefix'=>'checkouts'],function(){
    Route::get('/',[CheckoutController::class,'CheckoutPage'])->name('checkouts');
    Route::get('/form',[CheckoutController::class,'CheckoutForm'])->name('checkouts.form');
    Route::post('/store',[CheckoutController::class,'CheckoutStore'])->name('checkouts.store');
});

//Contact Page Routes
Route::get('/ContactPage',[ContactController::class,'ContactPage']);
Route::post('/ContactSend',[ContactController::class,'ContactSend']);





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
//slider
/*Route::get('/homeSlider',[HomeSlider::class,'HomeSlider']);*/




//backend Authentication login Routes
Route::get('/admin/login',[AdminController::class,'AdminLogin']);
Route::post('/admin/loginForm',[AdminController::class,'AdminLoginForm']);

/*Route::get('/admin/dashboard',[DashboardController::class,'AdminDashbord'])->middleware('admin');*/

Route::group(['middleware'=>'admin'],function(){
    Route::get('/admin/dashboard',[AdminDashboard::class,'AdminDashboard']);
    Route::get('/admin/logout',[AdminController::class,'AdminLogout']);
    Route::get('/products', [ProductController::class,'ProductIndex']);
    Route::get('/category', [CategoryController::class,'CategoryIndex']);
    Route::get('/brand', [BrandController::class,'BrandIndex']);
    Route::get('/sliders',[SliderController::class,'SliderPage']);
    Route::get('/customers', [CustomerController::class,'CustomerIndex']);
    Route::get('/users', [AdminUserController::class,'UserIndex']);
});

//Backend Routes
//Products Management

Route::get('/getProductsData', [ProductController::class,'ProductsData']);
Route::post('/ProductAdd', [ProductController::class,'ProductAdd']);
Route::post('/PorductDetails', [ProductController::class,'ProductDetails']);
Route::post('/UpdateProductDetails', [ProductController::class,'UpdateProduct']);
Route::post('/ProductDelete', [ProductController::class,'DeleteProduct']);

//Category Management System


Route::get('/getCategoryData', [CategoryController::class,'CategoryData']);
Route::post('/AddCategory', [CategoryController::class,'CategoryAdd']);
Route::post('/getCategoryDetails', [CategoryController::class,'CategoryDetails']);
Route::post('/CategoryUpdate', [CategoryController::class,'CategoryUpdate']);
Route::post('/DeleteCategory', [CategoryController::class,'CategoryDelete']);

//Brand Management System

Route::get('/getBrandsData', [BrandController::class,'getBrandsData']);
Route::post('/BrandAdd', [BrandController::class,'BrandAdd']);
Route::post('/getBrandDetails', [BrandController::class,'BrandDetails']);
Route::post('/UpdateBrand', [BrandController::class,'BrandUpdate']);
Route::post('/DeleteBrand', [BrandController::class,'BrandDelete']);

//Order Routes

Route::get('/orders',[OrdersController::class,'OrderPage'])->name('admin.orders');
Route::get('/orders/view/{id}',[OrdersController::class,'OrderShow'])->name('admin.orders.show');
Route::post('/orders/delete/{id}',[OrdersController::class,'OrderDelete'])->name('admin.orders.delete');
Route::post('/orders/completed/{id}',[OrdersController::class,'OrderComplete'])->name('admin.orders.complete');
Route::post('/orders/paid/{id}',[OrdersController::class,'OrderPaid'])->name('admin.orders.paid');
Route::post('/orders/charge-update/{id}',[OrdersController::class,'ChargeUpdate'])->name('admin.orders.charge');
Route::get('/orders/invoice/{id}',[OrdersController::class,'generateInvoice'])->name('admin.orders.invoice');

//Sliders

Route::get('/getSliderData', [SliderController::class,'SliderData']);
Route::post('/SliderAdd', [SliderController::class,'SliderAdd']);
Route::post('/SliderDetails', [SliderController::class,'SliderDetails']);
Route::post('/UpdateDetails', [SliderController::class,'SliderUpdate']);
Route::post('/DeleteSlider', [SliderController::class,'SliderDelete']);

//Customers Management Routes
Route::get('/getCustomerData',[CustomerController::class,'CustomerData']);
Route::post('/deleteCustomer',[CustomerController::class,'CustomerDelete']);

//User Management Routes
Route::get('/getUserData',[AdminUserController::class,'UserData']);
Route::post('/deleteUser',[AdminUserController::class,'UserDelete']);

//District Management System
Route::get('/admin/district', [DistrictController::class,'DistrictIndex']);
Route::get('/getDistrictData', [DistrictController::class,'DistrictData']);
Route::post('/DistrictAdd', [DistrictController::class,'DistrictAdd']);
Route::post('/getDistrictDetails', [DistrictController::class,'DistrictDetails']);
Route::post('/UpdateDistrict', [DistrictController::class,'DistrictUpdate']);
Route::post('/DeleteDistrict', [DistrictController::class,'DistrictDelete']);

//Division Management System

Route::get('/admin/division', [DivisionController::class,'DivisionIndex']);
Route::get('/getDivisionsData', [DivisionController::class,'DivisionData']);
Route::post('/DivisionsAdd', [DivisionController::class,'DivisionAdd']);
Route::post('/getDivisionsDetails', [DivisionController::class,'DivisionDetails']);
Route::post('/UpdateDivisions', [DivisionController::class,'DivisionUpdate']);
Route::post('/DeleteDivisions', [DivisionController::class,'DivisionDelete']);



//vendors Authentication login Routes
Route::get('/vendor/login',[VendorController::class,'VendorLogin']);
Route::post('/vendor/loginForm',[VendorController::class,'VendorLoginForm']);


Route::group(['middleware'=>'vendor'],function(){
    Route::get('/vendor/dashboard',[VendorDashboard::class,'vendorDashboard']);
    Route::get('/vendor/logout',[VendorController::class,'VendorLogout']);
    Route::get('/vendor/products', [VendorProduct::class,'VendorProducts']);
    Route::get('/vendor/category', [VendorCategory::class,'VendorCategory']);
    Route::get('/vendor/brand', [VendorBrand::class,'VendorBrand']);
});


//Vendor Product Management

Route::get('/getProductsData', [VendorProduct::class,'ProductsData']);
Route::post('/ProductAdd', [VendorProduct::class,'ProductAdd']);
Route::post('/PorductDetails', [VendorProduct::class,'ProductDetails']);
Route::post('/UpdateProductDetails', [VendorProduct::class,'UpdateProduct']);
Route::post('/ProductDelete', [VendorProduct::class,'DeleteProduct']);

//Vendor Category Management

Route::get('/getCategoryData', [VendorCategory::class,'CategoryData']);
Route::post('/AddCategory', [VendorCategory::class,'CategoryAdd']);
Route::post('/getCategoryDetails', [VendorCategory::class,'CategoryDetails']);
Route::post('/CategoryUpdate', [VendorCategory::class,'CategoryUpdate']);
Route::post('/DeleteCategory', [VendorCategory::class,'CategoryDelete']);





//Vendor Brand Management

Route::get('/getBrandsData', [VendorBrand::class,'getBrandsData']);
Route::post('/BrandAdd', [VendorBrand::class,'BrandAdd']);
Route::post('/getBrandDetails', [VendorBrand::class,'BrandDetails']);
Route::post('/UpdateBrand', [VendorBrand::class,'BrandUpdate']);
Route::post('/DeleteBrand', [VendorBrand::class,'BrandDelete']);
