<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'delivery', 'namespace' => 'Delivery'], function () {

    /* ---------------------- Authentication -------------------*/
    Route::post('login','AuthController@login');
    Route::post('register', 'AuthController@register');

    Route::post('get_code','ForgetPasswordController@get_code');
    Route::post('ConfirmCode','ForgetPasswordController@ConfirmCode');
    Route::post('UpdatePassword','ForgetPasswordController@UpdatePassword');

    Route::group(['middleware' => 'all_guards:delivery_api'], function () {

        Route::get('profile', 'AuthController@profile');
        Route::post('update_profile', 'AuthController@update_profile');
        Route::post('logout', 'AuthController@logout');

        /* ---------------------- notifications -------------------*/
        Route::get('notifications', 'NotificationController@notifications');
        Route::get('getNotificationsCount', 'NotificationController@getNotificationsCount');

        /* ---------------------- home -------------------*/
        Route::get('home','HomeController@index');
        Route::post('change_is_available','HomeController@change_is_available');

        /* ---------------------- orders -------------------*/
        Route::post('change_order_status', 'OrderController@change_order_status');
        Route::get('order_details', 'OrderController@order_details');
        Route::get('current_orders', 'OrderController@current_orders');
        Route::get('previous_orders', 'OrderController@previous_orders');
        Route::get('orders_by_status', 'OrderController@orders_by_status');

        /* ---------------------- statistics -------------------*/
        Route::get('delivery_setting', 'StatisticsController@index');

        Route::get('close_markets', 'MarketsController@index');

        /* ---------------------- wallet -------------------*/
        Route::post('convert_points', 'WalletController@convert_points');



    });
});
