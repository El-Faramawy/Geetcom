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
        Route::get('change_user_active/{id}','UserController@change_active')->name('change_user_active');
        Route::get('user_profile/{id}','UserController@user_profile')->name('user_profile');
        Route::post('multi_delete_users','UserController@multiDelete')->name('users.multiDelete');

        ################################### deliveries ##########################################
        Route::resource('deliveries','DeliveryController');
        Route::get('block_delivery/{id}','DeliveryController@block')->name('deliveries.block');
        Route::post('multi_delete_deliveries','DeliveryController@multiDelete')->name('deliveries.multiDelete');

        ################################### markets ##########################################
        Route::resource('markets','MarketController');
        Route::get('block_market/{id}','MarketController@block')->name('markets.block');
        Route::post('multi_delete_markets','MarketController@multiDelete')->name('markets.multiDelete');

        ################################### doctors ##########################################
        Route::resource('doctors','DoctorController');
        Route::get('block_doctor/{id}','DoctorController@block')->name('doctors.block');
        Route::post('multi_delete_doctors','DoctorController@multiDelete')->name('doctors.multiDelete');

        ################################### hospitals ##########################################
        Route::resource('hospitals','DoctorController');
        Route::post('multi_delete_hospitals','DoctorController@multiDelete')->name('hospitals.multiDelete');

        ################################### Branch ##########################################
        Route::resource('branches','BranchController');
        Route::post('multi_delete_branches','BranchController@multiDelete')->name('branches.multiDelete');

        ################################### categories ##########################################
        Route::resource('categories','CategoryController');
        Route::post('multi_delete_categories','CategoryController@multiDelete')->name('categories.multiDelete');

        ################################### degrees ##########################################
        Route::resource('degrees','DegreeController');
        Route::post('multi_delete_degrees','DegreeController@multiDelete')->name('degrees.multiDelete');

        ################################### sliders ##########################################
        Route::resource('sliders','SliderController');
        Route::post('multi_delete_sliders','SliderController@multiDelete')->name('sliders.multiDelete');

        ################################### brands ##########################################
        Route::resource('brands','BrandController');
        Route::post('multi_delete_brands','BrandController@multiDelete')->name('brands.multiDelete');

        ################################### parts ##########################################
        Route::resource('parts','PartController');
        Route::post('multi_delete_parts','PartController@multiDelete')->name('parts.multiDelete');

        ################################### part_types ##########################################
        Route::resource('part_types','PartTypeController');
        Route::post('multi_delete_part_types','PartTypeController@multiDelete')->name('part_types.multiDelete');

        ################################### contacts ##########################################
        Route::resource('contacts','ContactController');
        Route::get('replay_contact/{id}','ContactController@replay')->name('replay_contact');
        Route::post('post_replay_contact','ContactController@post_replay')->name('post_replay_contact');
        Route::post('multi_delete_contacts','ContactController@multiDelete')->name('contacts.multiDelete');

        ################################### settings ##########################################
        Route::resource('settings','SettingController');

        ################################### menus ##########################################
        Route::resource('menus','MenuController');
        Route::post('multi_delete_menus','MenuController@multiDelete')->name('menus.multiDelete');

        ################################### reservations ##########################################
        Route::resource('reservations','ReservationController');
        Route::get('change_reservation_status/{id}','ReservationController@change_reservation_status')->name('change_reservation_status');
        Route::post('update_reservation_status','ReservationController@update_reservation_status')->name('update_reservation_status');
        Route::get('reservation_details/{id}','ReservationController@reservation_details')->name('reservation_details');
        Route::post('multi_delete_reservations','ReservationController@multiDelete')->name('reservations.multiDelete');

        ################################### notifications ##########################################
        Route::resource('notifications','NotificationController');


    });//end Middleware Admin


//    Route::fallback(function () {
//        return redirect('admin/home');
//    });
    Route::get('/clear-cache', function() {
        Artisan::call('cache:clear');
        Artisan::call('optimize:clear');
        return '<h1> cache cleared</h1>';
    });
});//end Prefix
