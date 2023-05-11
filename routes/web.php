<?php

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
Route::get('/', function (){
   return redirect('admin/login');
})->name('welcome');

// ****************** web view *****************************
Route::get('terms', 'WebView\TermsController@terms')->name('terms');
Route::get('privacy', 'WebView\TermsController@privacy')->name('privacy');
Route::get('about', 'WebView\TermsController@about')->name('about');

