<?php

namespace App\Http\Controllers\Api\Delivery;

use App\Http\Controllers\Controller;
use App\Http\Traits\CanceledOrderTrait;
use App\Http\Traits\PaginateTrait;
use App\Http\Traits\WithRelationTrait;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    use WithRelationTrait, PaginateTrait , CanceledOrderTrait;

    /*================================================*/
    public function change_order_status(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id'      => 'required|exists:orders,id',
            'status'        => 'required|in:ended,canceled_from_delivery',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(),'simple', 422);
        }

        $order = Order::where('id', $request->order_id)->with($this->orderRelations())->first();
        $order->update(['status'=>$request->status]);

        $this->cancelOrder($order);

        if($order->status == 'ended'){
            if ($order->delivery){
                $delivery = $order->delivery;
                $delivery->points += setting()->delivery_order_points;
                $delivery->save();
            }
        }


//        $this->sendNotification(null, 'nuovo ordine ', 'nuovo ordine per te','admin');
//        $this->sendFCMNotification(null, 'nuovo ordine ', 'nuovo ordine per te','admin');

        return $this->apiResponse($order,'','simple');
    }

    /*================================================*/
    public function current_orders(Request $request){

        $orders = Order::where('delivery_id',delivery_api()->user()->id)
            ->whereIn('status',['in_market_way','wait_order','delivery'])
            ->with($this->orderRelations());

        return $this->apiResponse($orders);
    }
    /*================================================*/
    public function previous_orders(Request $request){

        $orders = Order::where('delivery_id',delivery_api()->user()->id)
            ->whereIn('status',['canceled_from_market', 'canceled_from_delivery','canceled_from_admin','ended'])
            ->with($this->orderRelations());

        return $this->apiResponse($orders);
    }
    /*================================================*/
    public function order_details(Request $request){
        $validator = Validator::make($request->all(),[
            'id'        =>  'required|exists:orders,id',
        ]);
        if ($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),'simple','422');
        }

        $order = Order::where('id',$request->id)
            ->with($this->orderRelations())
            ->first();

        return $this->apiResponse($order,'','simple');
    }

    /*================================================*/


}
