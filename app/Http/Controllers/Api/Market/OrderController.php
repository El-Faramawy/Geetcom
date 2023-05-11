<?php

namespace App\Http\Controllers\Api\Market;

use App\Http\Controllers\Controller;
use App\Http\Traits\CanceledOrderTrait;
use App\Http\Traits\PaginateTrait;
use App\Http\Traits\WithRelationTrait;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\OrderDetailsAdditions;
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
            'status'        => 'required|in:accepted,canceled_from_market',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(),'simple', 422);
        }

        $order = Order::where('id', $request->order_id)->with($this->orderRelations())->first();
        $order->update(['status'=>$request->status]);

        $this->cancelOrder($order);

        if($order->status == 'accepted'){
            $order->update(['from'=>date('H:i:s',strtotime('+'.market_api()->user()->min_from . ' minutes')) ,
                'to'=>date('H:i:s',strtotime('+'.market_api()->user()->min_to . ' minutes')) ]);
        }
//        $this->sendNotification(null, 'nuovo ordine ', 'nuovo ordine per te','admin');
//        $this->sendFCMNotification(null, 'nuovo ordine ', 'nuovo ordine per te','admin');

        return $this->apiResponse($order,'','simple');
    }

    /*================================================*/
    public function current_orders(Request $request){

        $orders = Order::where('market_id',market_api()->user()->id)
            ->whereIn('status',['new', 'accepted','in_market_way','wait_order','delivery'])
            ->with($this->orderRelations());

        return $this->apiResponse($orders);
    }
    /*================================================*/
    public function previous_orders(Request $request){

            $order = Order::where('market_id',market_api()->user()->id)
                ->whereIn('status',['canceled_from_market', 'canceled_from_delivery','canceled_from_admin','ended'])
                ->with($this->orderRelations());

        return $this->apiResponse($order);
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
