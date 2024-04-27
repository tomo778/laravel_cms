<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'mypage', 'App\Http\Controllers\middleware' => 'verified'], function () {
    Route::get('address', 'App\Http\Controllers\MypageController@addressApi');
    Route::post('address/update', 'App\Http\Controllers\MypageController@addressApiUpdate');
    Route::post('address/update_exe', 'App\Http\Controllers\MypageController@addressApiUpdateExe');
});

Route::group(['middleware' => 'api'], function() {
    Route::get('get',  'Admin\NewsController@get');
    Route::post('up',  'Admin_vueController@up');
    Route::post('add',  'TodoController@addTodo');  //←追記
  });
  
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

