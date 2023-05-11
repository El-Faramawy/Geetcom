<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\NotificationTrait;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Traits\PhotoTrait;


class SettingController extends Controller
{
    use PhotoTrait,NotificationTrait;

    public function index(){
        $setting = Setting::first();
        return view('Admin.Setting.index',compact('setting'));
    }
    public function update(Request $request , Setting $setting){
//        return $request->all();
        $data = $request->all();
        if ( $request->logo && $request->logo != null ){
            if (file_exists($setting->getAttributes()['logo'])) {
                unlink($setting->getAttributes()['logo']);
            }
            $data['logo']    = 'uploads/setting/'.$this->saveImage($request->logo,'uploads/setting');
        }

        if ( $request->fav_icon && $request->fav_icon != null ){
            if (file_exists($setting->getAttributes()['fav_icon'])) {
                unlink($setting->getAttributes()['fav_icon']);
            }
            $data['fav_icon']    = 'uploads/setting/'.$this->saveImage($request->fav_icon,'uploads/setting');
        }

        $setting->update($data);
        return response()->json(['messages' => ['تم التعديل بنجاح'], 'success' => 'true']);
    }
}
