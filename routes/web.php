<?php

use Illuminate\Support\Facades\Route;
//phpinfo();

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

/*
|--------------------------------------------------------------------------
| 公開側
|--------------------------------------------------------------------------
|
*/

Auth::routes([
	'register' => true,
	'reset' => true,
	'verify' => true
]);
Route::get('/', 'App\Http\Controllers\ProductController@index')->name('index');
Route::get('/product/{id}', 'App\Http\Controllers\ProductController@detail')->name('product');
Route::get('/category/{id}', 'App\Http\Controllers\ProductController@category')->name('category');
Route::group(['prefix' => 'contact'], function () {
	Route::get('/', 'App\Http\Controllers\ContactController@index')->name('contact');
	Route::post('/', 'App\Http\Controllers\ContactController@back');
	Route::post('confirm', 'App\Http\Controllers\ContactController@confirm')->name('contact_confirm');
	Route::post('finish', 'App\Http\Controllers\ContactController@finish')->name('contact_finish');
});
Route::group(['prefix' => 'cart'], function () {
	Route::get('/', 'App\Http\Controllers\CartController@index')->name('cart');
	Route::post('/', 'App\Http\Controllers\CartController@addItem');
	//ajax
	Route::post('remove', 'App\Http\Controllers\CartController@removeItem')->name('cart_remove');
	Route::post('quantity', 'App\Http\Controllers\CartController@quantityChange')->name('cart_quantity');
});
Route::group(['prefix' => 'purchase', 'middleware' => 'verified'], function () {
	Route::get('/', 'App\Http\Controllers\PurchaseController@index')->middleware('CheckCart')->name('purchase');
	Route::post('/', 'App\Http\Controllers\PurchaseController@back')->middleware('CheckCart');
	Route::post('confirm', 'App\Http\Controllers\PurchaseController@confirm')->middleware('CheckCart')->name('purchase_confirm');
	Route::post('finish', 'App\Http\Controllers\PurchaseController@finish')->middleware('CheckCart')->name('purchase_finish');
});
Route::group(['prefix' => 'mypage', 'middleware' => 'verified'], function () {
	Route::get('/', 'App\Http\Controllers\MypageController@index')->name('mypage');
	Route::get('address', 'App\Http\Controllers\MypageController@address')->name('mypage_address');
	Route::get('history', 'App\Http\Controllers\MypageController@history')->name('mypage_history');
	Route::get('create', 'App\Http\Controllers\MypageController@create')->name('mypage_create');
	Route::post('create_exe', 'App\Http\Controllers\MypageController@createExecute')->name('mypage_create_exe');
	Route::get('update/{id?}', 'App\Http\Controllers\MypageController@update')->name('mypage_update');
	Route::post('update_exe', 'App\Http\Controllers\MypageController@updateExecute')->name('mypage_update_exe');
});

/*
|--------------------------------------------------------------------------
| 管理側
|--------------------------------------------------------------------------
|
*/

Route::get('/admin/login', 'App\Http\Controllers\Admin\Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'App\Http\Controllers\Admin\Auth\LoginController@login')->name('admin.login');
Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin', 'AdminCommon']], function () {
	Route::get('/', 'App\Http\Controllers\Admin\IndexController@index')->name('admin.top');
	//認証  
	Route::get('logout', 'App\Http\Controllers\Admin\Auth\LoginController@logout')->name('admin.logout');
	//サイトナビ
	Route::get('top', "App\Http\Controllers\Admin\TopController@index")->name('admin_top');

	Route::get('staff', "App\Http\Controllers\Admin\StaffController@index")->name('admin_staff');
	Route::get('staff' . '/edit', "App\Http\Controllers\Admin\StaffController@create")->name('admin_create_staff');
	Route::post('staff' . '/edit/val', "App\Http\Controllers\Admin\StaffController@validateForm")->name('admin_val_staff');
	Route::post('staff' . '/edit', "App\Http\Controllers\Admin\StaffController@createExecute");
	Route::get('staff' . '/edit/{id}', "App\Http\Controllers\Admin\StaffController@update")->name('admin_update_staff');
	Route::post('staff/edit/{id}', "App\Http\Controllers\Admin\StaffController@updateExecute");

	Route::get('product', "App\Http\Controllers\Admin\ProductController@index")->name('admin_product');
	Route::get('product' . '/edit', "App\Http\Controllers\Admin\ProductController@create")->name('admin_create_product');
	Route::post('product' . '/edit/val', "App\Http\Controllers\Admin\ProductController@validateForm")->name('admin_val_product');
	Route::post('product' . '/edit', "App\Http\Controllers\Admin\ProductController@createExecute");
	Route::get('product' . '/edit/{id}', "App\Http\Controllers\Admin\ProductController@update")->name('admin_update_product');
	Route::post('product/edit/{id}', "App\Http\Controllers\Admin\ProductController@updateExecute");

	Route::get('category', "App\Http\Controllers\Admin\CategoryController@index")->name('admin_category');
	Route::get('category' . '/edit', "App\Http\Controllers\Admin\CategoryController@create")->name('admin_create_category');
	Route::post('category' . '/edit/val', "App\Http\Controllers\Admin\CategoryController@validateForm")->name('admin_val_category');
	Route::post('category' . '/edit', "App\Http\Controllers\Admin\CategoryController@createExecute");
	Route::get('category' . '/edit/{id}', "App\Http\Controllers\Admin\CategoryController@update")->name('admin_update_category');
	Route::post('category/edit/{id}', "App\Http\Controllers\Admin\CategoryController@updateExecute");

	//checkbox操作
	Route::post('product/checkbox', "App\Http\Controllers\Admin\ProductController@checkbox");
});
