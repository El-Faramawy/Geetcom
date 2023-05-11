<?php

namespace App\Http\Controllers\Api\Market;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Http\Traits\WithRelationTrait;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    use WithRelationTrait , PaginateTrait;
    public function index(Request $request){
        $data =[];
        $from_date = $request->from_date ? date('Y-m-d', strtotime($request->from_date)) : date('Y-m-d', strtotime('-1 day') );
        $to_date = $request->to_date ? date('Y-m-d', strtotime($request->to_date .' +1day')) : date('Y-m-d',strtotime(' +1 day'));

//        $day = $request->date?:date('Y-m-d');
        $orders = Order::where('market_id',market_api()->user()->id)->whereBetween('created_at',[$from_date, $to_date]);
        $data['total_orders'] = $orders->count();
        $data['current_orders'] = $orders->whereIn('status',['new','accepted'])->count();
        $data['ended_orders'] = Order::where(['market_id'=>market_api()->user()->id ,'status'=>'ended'])
            ->whereBetween('created_at',[$from_date, $to_date])->count();
        $data['canceled_orders'] =
            Order::where('market_id',market_api()->user()->id)
                ->whereBetween('created_at',[$from_date, $to_date])
                ->whereIn('status',['canceled_from_market', 'canceled_from_delivery','canceled_from_admin'])
            ->count();
        $data['total_profit'] = Order::where(['market_id'=>market_api()->user()->id ,'status'=>'ended'])
            ->whereBetween('created_at',[$from_date, $to_date])->sum('total');

        $data['most_sell_products'] = Product::whereHas('order_details'
//            ,function ($q) use ($from_date,$to_date){
//            $q->whereHas('order',function ($q2) use ($from_date,$to_date){
//                $q2->where(['market_id'=>market_api()->user()->id , 'status'=>'ended'])
//                    ->whereBetween('created_at',[$from_date, $to_date]);
//            });
//        }
        )->withCount('order_details')->orderBy('order_details_count','desc')->take(10)->get();

        return $this->apiResponse($data,null,'simple');
    }
    //================================================================

}
