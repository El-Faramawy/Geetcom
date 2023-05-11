<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('setting')) {
    function setting()
    {
        return \App\Models\Setting::orderBy('id', 'desc')->first();
    }
}

// ============================================================
if (!function_exists('aurl')) {
    function aurl($url = null)
    {
        return url('admin/' . $url);
    }
}

// ============================================================
if (!function_exists('admin')) {
    function admin()
    {
        return auth()->guard('admin');
    }
}
// ============================================================
if (!function_exists('user_api')) {
    function user_api()
    {
        return auth()->guard('user_api');
    }
}
// ============================================================
if (!function_exists('market_api')) {
    function market_api()
    {
        return auth()->guard('market_api');
    }
}
// ============================================================
if (!function_exists('delivery_api')) {
    function delivery_api()
    {
        return auth()->guard('delivery_api');
    }
}

// ============================================================
if (!function_exists('get_file')) {
    function get_file($file)
    {
        if (!is_null($file))
            return asset($file);
        else
            return asset('Admin/imgs/default.jpg');

    }
}
//===================  toaster ===========================
if (!function_exists('my_toaster')) {
    function my_toaster($message = 'تم بنجاح',$alert_type = 'success') {
        session()->flash('message', $message);
        session()->flash('type', $alert_type);
    }
}


//===================  getToken ===========================
if (!function_exists('getToken')) {
    function getToken() {
        $token = null;
        if (request()->header('auth_token') && request()->header('auth_token') != null)
            $token = request()->header('auth_token');
        elseif(request()->get('auth_token') && request()->get('auth_token') != null)
            $token = request()->get('auth_token');
        elseif(request()->auth_token && request()->auth_token != null)
            $token = request()->auth_token;
        return $token;
    }
}

