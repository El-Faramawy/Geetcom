<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Part;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index(Request $request){

//        $created_from = $request->created_from ? date('Y-m-d',strtotime($request->created_from)):date('2023-1-1');
//        $created_to = $request->created_to ?date('Y-m-d' ,strtotime($request->created_to)):date('Y-m-d' );
//
//        $chart_day_array = $chart_order_array = [];
//        $chart_order_count = 0;
//
//        for($i= 30 ; $i>=0 ; $i--){
//            array_push($chart_day_array , (string)date('d/m',strtotime('-'.$i.'day') ) );
//            $order = Order::where(['status'=>'ended'])->whereDate('created_at' , date('Y-m-d',strtotime('-'.$i.'day') ))->count();
//            $chart_order_count += $order;
//            array_push($chart_order_array , (string)$order );
//        }
//        $total_income = Order::where(['status'=>'ended'])->whereBetween('created_at',[date('Y-m-d',strtotime('-30day')  ),date('Y-m-d')])->count();
////        return $chart_order_array;
////        //*************** end target clients chart ******************
//
//        $order_count = Order::whereBetween('created_at',[$created_from,$created_to])->count();
//        $user_count = User::whereBetween('created_at',[$created_from,$created_to])->count();
//        $admin_count = Admin::whereBetween('created_at',[$created_from,$created_to])->count();
//        $contact_count = Contact::whereBetween('created_at',[$created_from,$created_to])->count();
//        $category_count = Category::whereBetween('created_at',[$created_from,$created_to])->count();
//        $sub_category_count = SubCategory::whereBetween('created_at',[$created_from,$created_to])->count();
//        $brand_count = Brand::whereBetween('created_at',[$created_from,$created_to])->count();
//        $part_count = Part::whereBetween('created_at',[$created_from,$created_to])->count();
//
//        $new_order_count = Order::whereBetween('created_at',[$created_from,$created_to])->where('status','new')->count();
//        $ended_order_count = Order::whereBetween('created_at',[$created_from,$created_to])->where('status','ended')->count();
//
//        //****************************************************************
//        $most_sell_parts = Part::whereHas('order_details',function ($query){
//            $query->whereHas('order',function ($query2){
//                $query2->where('status','ended');
//            });
//        })->withCount('order_details')->orderBy('order_details_count','desc')->take(10)->get();
//
//        $most_purchase_clients = User::whereHas('orders',function ($query){
//            $query->where('status','ended');
//        })->withCount('orders')->orderBy('orders_count','desc')->take(10)->get();
//
//        return view('Admin.index',['created_from'=>$created_from,'created_to'=>$created_to],
//            compact('chart_day_array','chart_order_array','chart_order_count' ,
//                'order_count','user_count','admin_count','contact_count' ,'new_order_count','ended_order_count'
//                ,'category_count','sub_category_count','brand_count','part_count','total_income'
//                ,'most_purchase_clients','most_sell_parts'
//                ));
//        return view('Admin.index',['created_from'=>$created_from,'created_to'=>$created_to],
//            compact('chart_day_array','chart_order_array','chart_order_count','schools_array',
//                'school_count','menu_count', 'order_count','user_count','admin_count','contact_count'
//                ,'new_order_count','on_going_order_count','ended_order_count','canceled_order_count'
//                ,'school_orders','school_tomorrow_orders'));
        return view('Admin.index');
    }

    //###################################################


}
