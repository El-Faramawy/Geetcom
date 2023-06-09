<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user', 'namespace' => 'User'], function () {

    /* ---------------------- Authentication -------------------*/
    Route::post('login','AuthController@login');
    Route::post('register', 'AuthController@register');

    Route::post('get_register_code','AuthController@get_register_code');
    Route::post('ConfirmRegisterCode','AuthController@ConfirmRegisterCode');

    Route::post('get_code','ForgetPasswordController@get_code');
    Route::post('ConfirmCode','ForgetPasswordController@ConfirmCode');
    Route::post('UpdatePassword','ForgetPasswordController@UpdatePassword');


    Route::group(['middleware' => 'all_guards:user_api'], function () {

        Route::get('profile', 'AuthController@profile');
        Route::post('update_profile', 'AuthController@update_profile');
        Route::post('logout', 'AuthController@logout');

        /* ---------------------- notifications -------------------*/
        Route::get('wallet_coupon', 'WalletController@wallet_coupon');
        Route::post('update_points', 'WalletController@update_points');
        Route::post('add_wallet','WalletController@add_wallet');

        /* ---------------------- notifications -------------------*/
        Route::get('notifications', 'NotificationController@notifications');
        Route::get('getNotificationsCount', 'NotificationController@getNotificationsCount');

        /* ---------------------- home -------------------*/
        Route::get('home','HomeController@index');
        Route::get('market_search','HomeController@market_search');
        Route::get('get_delivery_data','HomeController@get_delivery_data');

        /* ---------------------- Category -------------------*/
        Route::get('category','CategoryController@index');
        Route::get('category_markets','CategoryController@category_markets');

        /* ---------------------- market -------------------*/
        Route::get('market','MarketController@index');
        Route::get('market_all_data','MarketController@market_all_data');

        /* ---------------------- product -------------------*/
        Route::get('product','ProductController@index');

        /* ---------------------- favourite -------------------*/
        Route::post('add_delete_favourite','FavouriteController@add_delete_favourite');
//        Route::post('delete_favourite','FavouriteController@delete_favourite');
        Route::get('favourite_markets','FavouriteController@favourite_markets');
        Route::get('favourite_products','FavouriteController@favourite_products');

        /* ---------------------- address -------------------*/
        Route::get('userAddresses', 'AddressController@index');
        Route::post('addAddress', 'AddressController@addAddress');
//        Route::post('editAddress', 'AddressController@editAddress');
        Route::post('deleteAddress', 'AddressController@deleteAddress');

        /* ---------------------- coupons -------------------*/
        Route::get('current_coupons', 'CouponController@current_coupons');

        /* ---------------------- cart -------------------*/
        Route::get('get_cart','CartController@get_cart');
        Route::post('add_cart','CartController@add_cart');
        Route::post('delete_cart','CartController@delete_cart');

        /* ---------------------- orders -------------------*/
        Route::get('coupon', 'OrderController@coupon');
        Route::post('store_order', 'OrderController@store_order');
        Route::get('order_details', 'OrderController@order_details');
        Route::get('current_orders', 'OrderController@current_orders');
        Route::get('previous_orders', 'OrderController@previous_orders');
        Route::post('rate_order', 'OrderController@rate_order');
        Route::post('support_order', 'OrderController@support_order');
        Route::post('change_order_status', 'OrderController@change_order_status');

        /* ---------------------- contact -------------------*/
        Route::post('contact_with_user','ContactController@contact_with_user');

        /* ---------------------- chat -------------------*/
        Route::get('get_chat','ChatController@get_chat');
        Route::post('send_message','ChatController@send_message');





    });
});
