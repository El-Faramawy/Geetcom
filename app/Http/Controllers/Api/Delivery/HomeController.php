<?php

namespace App\Http\Controllers\Api\Delivery;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Http\Traits\WithRelationTrait;
use App\Models\Delivery;
use App\Models\Notification;
use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
use WithRelationTrait , PaginateTrait;
    public function index(Request $request){
        $data =[];
        $day = date('Y-m-d',strtotime($request->date))?:date('Y-m-d');
//        return $day;
        $data['ended_orders'] = Order::where(['delivery_id'=>delivery_api()->user()->id , 'status'=>'ended'])
            ->whereDate('created_at',$day)->count();
        $data['canceled_orders'] = Order::where(['delivery_id'=>delivery_api()->user()->id ])
            ->whereIn('status',['canceled_from_market', 'canceled_from_delivery','canceled_from_admin'])
            ->whereDate('created_at',$day)->count();
        $data['delivery_orders'] = Order::where(['delivery_id'=>delivery_api()->user()->id ])
            ->whereIn('status',['in_market_way','wait_order','delivery'])
            ->whereDate('created_at',$day)->count();

        $data['offers'] = Notification::where(['delivery_id'=>delivery_api()->user()->id,'type'=>'offer' ])
            ->whereDate('created_at',$day)->count();
        $data['rewards'] = Notification::where(['delivery_id'=>delivery_api()->user()->id,'type'=>'reward' ])
            ->whereDate('created_at',$day)->count();

        return $this->apiResponse($data,null,'simple');
    }
    //================================================================

    public function change_is_available(Request $request){
        $delivery = Delivery::where('id',delivery_api()->user()->id)->first();
        $delivery->update(['is_available'=>$request->is_available]);
        return $this->apiResponse($delivery,'','simple');
    }
    //================================================================
}
