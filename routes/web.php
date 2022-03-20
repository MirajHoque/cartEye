<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SubSubCategoryController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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


/*************************************
            Admin Route
 *************************************/
Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function(){
    Route::get('/login', [AdminController::class, 'loginFrom']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

 
Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
Route::get('/admin/profile', [AdminProfileController::class, 'adminProifle'])->name('admin.profile');
Route::get('/admin/profile/edit', [AdminProfileController::class, 'adminProifleEdit'])->name('admin.profile.edit');
Route::post('/admin/profile/store', [AdminProfileController::class, 'store'])->name('admin.profile.update');
Route::get('/admin/change/password', [AdminProfileController::class, 'changePassword'])->name('admin.change.password');
Route::post('/admin/update/password', [AdminProfileController::class, 'updatePassword']);

/*************************************
            Brand Route
 *************************************/

Route::prefix('brand')->group(function(){
    Route::get('/show', [BrandController::class, 'showBrand'])->name('all.brands');
    Route::post('/store', [BrandController::class, 'store'])->name('brand.store');

});

/*************************************
            Category Route
 *************************************/

Route::prefix('category')->group(function(){
    Route::get('/show', [CategoryController::class, 'showCategory'])->name('all.categories');
    Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/update', [CategoryController::class, 'update']);
    Route::get('/remove/{id}', [CategoryController::class, 'remove'])->name('category.remove');

/*************************************
            SubCategory Route
 *************************************/

    Route::get('/sub/show', [SubCategoryController::class, 'showSubCategory'])->name('all.subCategories');
    Route::post('/sub/store', [SubCategoryController::class, 'store'])->name('subCategory.store');
    Route::get('sub/edit/{id}', [SubCategoryController::class, 'edit'])->name('subCategory.edit');
    Route::post('/sub/update', [SubCategoryController::class, 'update']);
    Route::get('/sub/remove/{id}', [SubCategoryController::class, 'remove'])->name('subCategory.remove');

/*************************************
            Sub SubCategory Route
 *************************************/

    Route::get('/sub/sub/show', [SubSubCategoryController::class, 'showSubSubCategory'])->name('all.subSubCategories');
    Route::get('/subcategory/grave/{categoryId}', [SubSubCategoryController::class, 'grave']);
    Route::get('/sub/subcategory/grave/{subCategoryId}', [SubSubCategoryController::class, 'graveSubSubCategory']);
    Route::post('/sub/sub/store', [SubSubCategoryController::class, 'store'])->name('subSubCategory.store');
    Route::get('sub/sub/edit/{id}', [SubSubCategoryController::class, 'edit'])->name('subSubCategory.edit');
    Route::post('/sub/sub/update', [SubSubCategoryController::class, 'update']);
    Route::get('/sub/sub/remove/{id}', [SubSubCategoryController::class, 'remove'])->name('subSubCategory.remove');

});

/*************************************
            Product Route
 *************************************/
Route::prefix('product')->group(function (){
    Route::get('/add', [ProductController::class, 'addProduct'])->name('add.product');
    Route::post('/store', [ProductController::class, 'store']);
    Route::get('/manage', [ProductController::class, 'manage'])->name('manage.product');
});





/*************************************
            User Route
 *************************************/

Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $id = Auth::user()->id;
    //dd($id);
    $user = User::find($id);
    //dd($user);
    return view('dashboard', compact('user'));
})->name('dashboard');

Route::get('/', [IndexController::class, 'index']);
Route::get('/user/logout', [IndexController::class, 'logOut'])->name('user.logout');
Route::get('/user/profile', [IndexController::class, 'userProfile'])->name('user.profile');
Route::post('/user/profile/store', [ProfileController::class, 'store']);
Route::get('/user/change/password', [ProfileController::class, 'changePassword'])->name('change.password');
Route::post('/user/update/password', [ProfileController::class, 'updatePassword']);
