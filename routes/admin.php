<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'admin'], function () {
    Route::get('login','AuthController@index')->name('login');
    Route::post('post_login','AuthController@login')->name('post_login');


    //******* after login *******
    Route::group(['middleware' => 'admin'], function () {

        Route::get('logout','AuthController@logout')->name('logout');

        Route::get('/',function (){
            return redirect('admin/home');
        })->name('/');
        Route::get('home','HomeController@index')->name('home');

        ################################### Profile ##########################################
        Route::get('profile','AdminController@profile')->name('profile');
        Route::post('update-profile','AdminController@update_profile')->name('profile.update');

        ################################### Admins ##########################################
        Route::resource('admins','AdminController');
        Route::post('multi_delete_admins','AdminController@multiDelete')->name('admins.multiDelete');

        ################################### users ##########################################
        Route::resource('users','UserController');
        Route::get('block_user/{id}','UserController@block')->name('users.block');
        Route::post('multi_delete_users','UserController@multiDelete')->name('users.multiDelete');

        ################################### deliveries ##########################################
        Route::resource('deliveries','DeliveryController');
        Route::get('block_delivery/{id}','DeliveryController@block')->name('deliveries.block');
        Route::post('multi_delete_deliveries','DeliveryController@multiDelete')->name('deliveries.multiDelete');

        ################################### markets ##########################################
        Route::resource('markets','MarketController');
        Route::get('block_market/{id}','MarketController@block')->name('markets.block');
        Route::post('multi_delete_markets','MarketController@multiDelete')->name('markets.multiDelete');
        Route::get('get_market_sub_categories','MarketController@get_market_sub_categories')->name('get_market_sub_categories');

        ################################### categories ##########################################
        Route::resource('categories','CategoryController');
        Route::post('multi_delete_categories','CategoryController@multiDelete')->name('categories.multiDelete');

        ################################### sub_categories ##########################################
        Route::resource('sub_categories','SubCategoryController');
        Route::post('multi_delete_sub_categories','SubCategoryController@multiDelete')->name('sub_categories.multiDelete');

        ################################### sliders ##########################################
        Route::resource('sliders','SliderController');
        Route::post('multi_delete_sliders','SliderController@multiDelete')->name('sliders.multiDelete');

        ################################### contacts ##########################################
        Route::resource('contacts','ContactController');
        Route::get('replay_contact/{id}','ContactController@replay')->name('replay_contact');
        Route::post('post_replay_contact','ContactController@post_replay')->name('post_replay_contact');
        Route::post('multi_delete_contacts','ContactController@multiDelete')->name('contacts.multiDelete');

        ################################### settings ##########################################
        Route::resource('settings','SettingController');

        ################################### products ##########################################
        Route::resource('products','ProductController');
        Route::get('get_market_categories','ProductController@get_market_categories')->name('get_market_categories');
        Route::get('get_market_sub_categories','ProductController@get_market_sub_categories')->name('get_market_sub_categories');
        Route::post('multi_delete_products','ProductController@multiDelete')->name('products.multiDelete');

        ################################### Coupon ##########################################
        Route::resource('coupons','CouponController');
        Route::post('multi_delete_coupons','CouponController@multiDelete')->name('coupons.multiDelete');

        ################################### Addition ##########################################
        Route::resource('additions','AdditionController');
        Route::post('multi_delete_additions','AdditionController@multiDelete')->name('additions.multiDelete');

        ################################### addition_categories ##########################################
        Route::resource('addition_categories','AdditionCategoryController');
        Route::post('multi_delete_addition_categories','AdditionCategoryController@multiDelete')->name('addition_categories.multiDelete');

        ################################### orders ##########################################
        Route::resource('orders','OrderController');
        Route::get('change_order_status/{id}','OrderController@change_order_status')->name('change_order_status');
        Route::post('update_order_status','OrderController@update_order_status')->name('update_order_status');
        Route::get('order_details/{id}','OrderController@order_details')->name('order_details');
        Route::post('multi_delete_orders','OrderController@multiDelete')->name('orders.multiDelete');

        ################################### supports ##########################################
        Route::resource('supports','SupportController');
        Route::get('support_details/{id}','SupportController@support_details')->name('support_details');
        Route::post('multi_delete_supports','SupportController@multiDelete')->name('supports.multiDelete');

        ################################### notifications ##########################################
        Route::resource('notifications','NotificationController');

        ################################### chats ##########################################
        Route::resource('chats','ChatController');
        Route::post('send_chat','ChatController@send_chat')->name('send_chat');


        Route::get('event_test',function (){
           event(new \App\Events\chat(1));

        });
    });//end Middleware Admin

    Route::get('order_copy/{id}','OrderController@order_copy')->name('order_copy');


//    Route::fallback(function () {
//        return redirect('admin/home');
//    });
    Route::get('/clear-cache', function() {
        Artisan::call('cache:clear');
        Artisan::call('optimize:clear');
        return '<h1> cache cleared</h1>';
    });
});//end Prefix
