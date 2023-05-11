<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Events\MyEvent;
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

/* ---------------------- Auth -------------------*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('get_code','ForgetPasswordController@get_code');
Route::post('ConfirmCode','ForgetPasswordController@ConfirmCode');
Route::post('UpdatePassword','ForgetPasswordController@UpdatePassword');

/* ---------------------- setting -------------------*/
Route::get('setting','SettingController@setting');

/* ---------------------- sub_category -------------------*/
Route::get('sub_category','SubCategoryController@index');
Route::get('sub_category_search','SubCategoryController@sub_category_search');

/* ---------------------- contact_us -------------------*/
Route::post('contact_us','ContactController@contact_us');

/* ---------------------- setting -------------------*/
Route::post('setting','SettingController@setting');



require __DIR__ . '/Api/user_api.php';
require __DIR__ . '/Api/market_api.php';
require __DIR__ . '/Api/delivery_api.php';



