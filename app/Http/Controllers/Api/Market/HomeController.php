<?php

namespace App\Http\Controllers\Api\Market;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Http\Traits\WithRelationTrait;
use App\Models\Category;
use App\Models\Market;
use App\Models\Order;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
use WithRelationTrait , PaginateTrait;
    public function index(Request $request){
        $data =[];
        $chart_day = $request->date ? date('Y-m-d',strtotime($request->date)):date('Y-m-d');
        $day = date('Y-m-d');
        $ended_orders = Order::where(['market_id'=>market_api()->user()->id , 'status'=>'ended'])->whereDate('created_at',$day);
        $data['ended_orders'] = $ended_orders->count();
        $data['total_profit'] = $ended_orders->sum('total');
        $data['canceled_orders'] = Order::where(['market_id'=>market_api()->user()->id ])
            ->whereIn('status',['canceled_from_market', 'canceled_from_delivery','canceled_from_admin'])
            ->whereDate('created_at',$day)->count();

        $data['days_order'] = [];

        for($i =0;$i <= 9;$i++){
            $data['days_order'][$i]['order_number'] = Order::where(['market_id'=>market_api()->user()->id , 'status'=>'ended'])
                ->whereDate('created_at',date('Y-m-d',strtotime($chart_day .'-'.$i.' day')) )->count();
            $data['days_order'][$i]['date'] = date('Y-m-d',strtotime($chart_day .'-'.$i.' day'));
        }

        return $this->apiResponse($data,null,'simple');
    }
    //================================================================

    public function change_is_available(Request $request){
        $market = Market::where('id',market_api()->user()->id)->first();
        $market->update(['is_available'=>$request->is_available]);
        return $this->apiResponse($market,'','simple');
    }
    //================================================================
}
