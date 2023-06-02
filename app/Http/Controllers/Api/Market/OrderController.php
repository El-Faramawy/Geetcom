<?php

namespace App\Http\Controllers\Api\Market;

use App\Http\Controllers\Controller;
use App\Http\Traits\CanceledOrderTrait;
use App\Http\Traits\NotificationTrait;
use App\Http\Traits\PaginateTrait;
use App\Http\Traits\WithRelationTrait;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\OrderDetailsAdditions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    use WithRelationTrait, PaginateTrait , CanceledOrderTrait,NotificationTrait;

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
        if ( $request->status == 'delivery') {
            return $this->apiResponse(null, 'order status is delivery','simple', 422);
        }

        $order = Order::where('id', $request->order_id)->with($this->orderRelations())->first();
        $order->update(['status'=>$request->status]);

        $this->cancelOrder($order);

        if($order->status == 'accepted'){
            $order->update(['from'=>date('H:i:s',strtotime('+'.market_api()->user()->min_from . ' minutes')) ,
                'to'=>date('H:i:s',strtotime('+'.market_api()->user()->min_to . ' minutes')),
                'accepted_time'=>date('H:i:s')]);
//            $this->sendAllNotifications([$order->user_id], 'تم قبول الطلب من المتجر', 'تم قبول الطلب من المتجر','user',$order);
            $deliveries = Delivery::whereHas('orders',function ($query){
                $query->whereIn('status',['accepted','in_market_way','wait_order','delivery']);
            })->withCount('orders')
                ->having('orders_count', '>=', 2)
//                ->where('orders_count','>=',2)
//                ->selectRaw('id, ( 3959 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance', [$order->address->latitude, $order->address->longitude, $order->address->latitude])
                ->pluck('id')->toArray();
//            return $deliveries;
            $otherDel = Delivery::whereNotIn('id',$deliveries)
                ->where('is_available','yes')
                ->selectRaw('id, ( 3959 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance', [$order->address->latitude, $order->address->longitude, $order->address->latitude])
                ->get();
            $del = [];
            foreach ($otherDel as $delivery){
                if ($delivery->distance <= setting()->num_of_kilos_for_delivery){
                    $del[] = $delivery->id;
                }
            }


            $this->sendAllNotifications([$order->user_id], 'تم قبول طلبك', 'تم قبول طلبك من المطعم','user',$order);
            $this->sendAllNotifications($del, 'طلب جديد', 'يوجد طلب جديد بالقرب منك','delivery',$order);
        }

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
    public function orders_by_status(Request $request){

            $order = Order::where(['market_id'=>market_api()->user()->id,'status'=>$request->status])
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
