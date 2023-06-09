<?php

namespace App\Http\Controllers\Api\Delivery;

use App\Http\Controllers\Controller;
use App\Http\Traits\CanceledOrderTrait;
use App\Http\Traits\NotificationTrait;
use App\Http\Traits\PaginateTrait;
use App\Http\Traits\WithRelationTrait;
use App\Models\Delivery;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    use WithRelationTrait, PaginateTrait , CanceledOrderTrait,NotificationTrait;

    /*================================================*/
    public function change_order_status(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id'      => 'required|exists:orders,id',
            'status'        => 'required|in:ended,in_market_way,wait_order,delivery,canceled_from_delivery',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(),'simple', 422);
        }

        $order = Order::where('id', $request->order_id)->with($this->orderRelations())->first();
        if ($order->delivery_id && $request->status == 'in_market_way') {
            return $this->apiResponse(null, 'order accepted by other delivery','simple', 422);
        }
        if ( $request->status == 'canceled_from_delivery'){
            $order->update(['status'=>'accepted', 'delivery_id'=>null]);
            $this->cancelOrder($order);

            $deliveries = Delivery::whereHas('orders',function ($query){
                $query->whereIn('status',['accepted','in_market_way','wait_order','delivery']);
            })->withCount('orders')
                ->having('orders_count', '>=', 2)
                ->pluck('id')->toArray();

            $otherDel = Delivery::whereNotIn('id',$deliveries)
                ->where([['is_available','yes'],['id','!=',delivery_api()->user()->id]])
                ->selectRaw('id, ( 3959 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance', [$order->address->latitude, $order->address->longitude, $order->address->latitude])
                ->get();
            $del = [];
            foreach ($otherDel as $delivery){
                if ($delivery->distance <= setting()->num_of_kilos_for_delivery){
                    $del[] = $delivery->id;
                }
            }

            $this->sendAllNotifications($del, 'طلب جديد', 'يوجد طلب جديد بالقرب منك','delivery',$order);
        }
        else{
            $order->update(['status'=>$request->status]);

            if($order->status == 'ended'){
                if ($order->delivery){
                    $delivery = $order->delivery;
                    $delivery->points += setting()->delivery_order_points;
                    $delivery->save();
                }
                $this->sendAllNotifications([$order->user_id], 'تم توصيل طلبك بنجاح', 'تم توصيل طلبك بنجاح الان بطلباتك السابقة','user',$order);
            }
            if($order->status == 'in_market_way'){
                $order->update(['delivery_id'=>delivery_api()->user()->id]);
            }
            if($order->status == 'delivery'){
                $order->update(['delivery_time'=>date('H:i:s')]);
                $this->sendAllNotifications([$order->user_id], 'جارى توصيل طلبك', 'جارى توصيل طلبك','user',$order);
            }
        }
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
    public function orders_by_status(Request $request){

        $order = Order::where(['delivery_id'=>delivery_api()->user()->id,'status'=>$request->status])
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
