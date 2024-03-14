<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\SubCategoryController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\VendorProductController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

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
//     return view('frontend.index');
// });
Route::get('/', function () {
    return view('welcome');
}); 
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('user.dashboard');

Route::get('admin/login',[AdminController::class,'AdminLogin'])->middleware(RedirectIfAuthenticated::class);
Route::get('vendor/login',[VendorController::class,'VendorLogin'])->middleware(RedirectIfAuthenticated::class);

Route::middleware(['auth'])->group(function(){
    Route::get("/dashboard",[UserController::class,'UserDashboard'])->name('dashboard');
    Route::post("user/profile/store",[UserController::class,'UserProfileStore'])->name('user.profile.store');
    Route::get("user/change_password",[UserController::class,'UserChangePassword'])->name('user.change.password');
    Route::post("user/change_password",[UserController::class,'UserUpdatePassword'])->name('user.update.password');
    Route::get("user/logout",[UserController::class,'UserLogout'])->name('user.logout');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'=>'role:admin'])->group(function(){
    Route::get('/admin/dashboard',[AdminController::class,'AdminDashboard'])->name('admin.dashboard');
    Route::get('admin/logout',[AdminController::class,'AdminDestory'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');

    Route::get('/admin/change_password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/change_password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');
    Route::get('admin/active_vendor',[AdminController::class, 'ActiveVendor'])->name('active.vendor');
     Route::get('admin/inactive_vendor',[AdminController::class, 'InActiveVendor'])->name('inactive.vendor');
     Route::post('active/vendor/{id}',[AdminController::class, 'ActiveId'])->name('active.id');
      Route::post('inactive/vendor/{id}',[AdminController::class, 'InActiveId'])->name('inactive.id');
});


Route::middleware(['auth'=>'role:vendor'])->group(function(){
    Route::get('/vendor/dashboard',[VendorController::class,'VendorDashboard'])->name('vendor.dashboard');
    Route::get('vendor/logout',[VendorController::class,'VendorDestory'])->name('vendor.logout');
    Route::get('/vendor/profile', [VendorController::class, 'VendorProfile'])->name('vendor.profile');
    Route::post('/vendor/profile', [VendorController::class, 'VendorProfileStore'])->name('vendor.profile.store');

    Route::get('/vendor/change_password', [VendorController::class, 'VendorChangePassword'])->name('vendor.change.password');
    Route::post('/vendor/change_password', [VendorController::class, 'VendorUpdatePassword'])->name('vendor.update.password');

   //ProductVendorController group
  Route ::controller(VendorProductController::class)->group(function(){
    Route::get('vendor/all/product','VendorAllProduct')->name('vendor.all.product');
  });



});
Route::get('admin/login', [AdminController::class,'AdminLogin']);
Route::get('vendor/login', [VendorController::class,'VendorLogin']);//name('vendor.login')
Route::get('/become/vendor', [VendorController::class, 'BecomeVendor'])->name('become.vendor');
Route::post('/vendor/register', [VendorController::class, 'VendorRegister'])->name('vendor.register');

Route::controller(BrandController::class)->group(function(){

    Route::get('/all/brand','AllBrand')->name('all.brand');
    Route::get('/add/brand','AddBrand')->name('add.brand');
    Route::post('/store/brand','StoreBrand')->name('store.brand');
    Route::get('/edit/brand/{id}','EditBrand')->name('edit.brand');
    Route::post('/update/brand','UpdateBrand')->name('update.brand');
    Route::get('/delete/brand/{id}','DeleteBrand')->name('delete.brand');

});

Route::controller(CategoryController::class)->group(function(){

    Route::get('/all/category','AllCategory')->name('all.category');
    Route::get('/add/category','AddCategory')->name('add.category');
    Route::post('/store/category','StoreCategory')->name('store.category');
    Route::get('/edit/category/{id}','EditCategory')->name('edit.category');
    Route::post('/update/category','UpdateCategory')->name('update.category');
    Route::get('/delete/category/{id}','DeleteCategory')->name('delete.category');

});

Route::controller(SubCategoryController::class)->group(function(){

    Route::get('/all/subcategory','AllSubCategory')->name('all.subcategory');
    Route::get('/add/subcategory','AddSubCategory')->name('add.subcategory');
    Route::post('/store/subcategory','StoreSubCategory')->name('store.subcategory');
    Route::get('/edit/subcategory/{id}','EditSubCategory')->name('edit.subcategory');
    Route::post('/update/subcategory','UpdateSubCategory')->name('update.subcategory');
    Route::get('/delete/subcategory/{id}','DeleteSubCategory')->name('delete.subcategory');

    Route::get('/subcategory/ajax/{category_id}','GetSubCategory');

});

// Route::controller(VendorController::class)->group(function(){
//     Route::get('become/vendor','BecomeVendor')->name('become.vendor');
// });
Route ::controller(ProductController::class)->group(function(){
    Route::get('/all/product','AllProduct')->name('all.product');
    Route::get('/add/product','AddProduct')->name('add.product');
    Route::post('/store/product','StoreProduct')->name('store.product');
    Route::get('/edit/product/{id}' , 'EditProduct')->name('edit.product');
    Route::post('/update/product' , 'UpdateProduct')->name('update.product');
    Route::get('/delete/product/{id}' , 'DeleteProduct')->name('delete.product');
    Route::get('/active/product/{id}' , 'ActiveProduct')->name('active.product');
    Route::get('/inactive/product/{id}' , 'InactiveProduct')->name('inactive.product');

    Route::post('/update/thambnail' , 'UpdateProductThambnail')->name('update.thambnail');
    Route::post('/update/multiimage' , 'UpdateProductMultiimage')->name('update.multiimage');
    Route::get('/product/multiimg/delete/{id}' , 'MulitImageDelelte')->name('product.multiimg.delete');
    

});

Route ::controller(VendorProductController::class)->group(function(){
    Route::get('vendor/all/product','VendorAllProduct')->name('vendor.all.product');
    Route::get('vendor/add/product','VendorAddProduct')->name('vendor.add.product');
    Route::post('vendor/store/product','StoreProduct')->name('vendor.store.product');
    // Route::get('/edit/product/{id}' , 'EditProduct')->name('edit.product');
    // Route::post('/update/product' , 'UpdateProduct')->name('update.product');
    // Route::get('/delete/product/{id}' , 'DeleteProduct')->name('delete.product');
    // Route::get('/active/product/{id}' , 'ActiveProduct')->name('active.product');
    // Route::get('/inactive/product/{id}' , 'InactiveProduct')->name('inactive.product');

    // Route::post('/update/thambnail' , 'UpdateProductThambnail')->name('update.thambnail');
    // Route::post('/update/multiimage' , 'UpdateProductMultiimage')->name('update.multiimage');
    // Route::get('/product/multiimg/delete/{id}' , 'MulitImageDelelte')->name('product.multiimg.delete');
    

});

