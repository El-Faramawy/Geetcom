<?php

namespace App\Http\Controllers\WebView;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class TermsController extends Controller
{
    public function terms(){
        $setting = Setting::first();
        return view('WebView.terms', ['setting' => $setting]);
    }
    public function privacy(){
        $setting = Setting::first();
        return view('WebView.privacy', ['setting' => $setting]);
    }
    public function about(){
        $setting = Setting::first();
        return view('WebView.about', ['setting' => $setting]);
    }
    public function training(){
        $setting = Setting::first();
        return view('WebView.training', ['setting' => $setting]);
    }
}
