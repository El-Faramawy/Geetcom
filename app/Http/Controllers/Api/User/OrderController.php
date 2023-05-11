<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Http\Traits\PhotoTrait;
use App\Http\Traits\WithRelationTrait;
use App\Models\Coupon;
use App\Models\CouponUser;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\OrderDetailsAdditions;
use App\Models\Rate;
use App\Models\Support;
use App\Models\SupportProducts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    use WithRelationTrait, PaginateTrait,PhotoTrait;
    //======================================================================
    public function coupon(Request $request){
        $validator = Validator::make($request->all(),[
            'code'=>'required',
        ]);
        if ($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),'simple','422');
        }

        $coupon = Coupon::where(['is_available'=>'yes','coupon_on'=>'purchases','code'=>$request->code])->first();

        if ($coupon){
            $coupon_user = CouponUser::where(['coupon_id'=>$coupon->id,'user_id'=>user_api()->user()->id])->first();
            if($coupon_user){
                if ($coupon_user->is_paid == 'no')
                    return $this->apiResponse($coupon,'','simple');
                else
                    return $this->apiResponse(null,'coupon is used before from the user','simple',411);
            }else{
                return $this->apiResponse(null,'coupon is not allowed for this user','simple',410);
            }
        }else{
            return $this->apiResponse(null,'coupon is wrong','simple',409);
        }

    }

    /*================================================*/
    public function store_order(Request $request)
    {
        //####################  start validation ###########################
        $validator = Validator::make($request->all(), [
            'total'                 => 'required',
            'address_id'            => 'exists:addresses,id',
            'coupon_id'            => 'exists:coupons,id',
            'market_id'            => 'required|exists:markets,id',
            "details.*.product_id"  => "required",
            "pay_type"              => "required|in:wallet,online",
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(),'simple', 422);
        }

//        if ($request->id) {
//            $old_order = Order::where('id', $request->id)->first();
//            if ($old_order->status != 'new' && $old_order->status != 'accepted')
//                return $this->apiResponse(null, "you can't edit order",'simple', 410);
//            else {
//                if ($old_order->coupon_id != null) {
//                    CouponUser::where(['user_id' => user_api()->user()->id, 'coupon_id' => $old_order->coupon_id])->update(['is_paid' => 'no']);
//                }
//                $old_order->delete();
//            }
//        }

        $copon = CouponUser::where(['user_id' => user_api()->user()->id, 'coupon_id' => $request->coupon_id,'is_paid' => 'yes'])->first();
        if ($copon) {
            return $this->apiResponse(null, 'coupon is used before','simple', 411);
        }

        $data = $request->only('pay_type', 'total', 'address_id', 'coupon_id','market_id', 'notes');
        $data['user_id'] = user_api()->user()->id;
        if ($request->pay_type == 'wallet'){
            if (user_api()->user()->wallet >= $data['total'] ){
                user_api()->user()->update(['wallet'=>user_api()->user()->wallet - $data['total'] ]);
                $data['wallet_pay'] = $data['total'];
                $data['status'] = 'new';
            }else{
                $data['status'] = 'not_paid';
                $data['wallet_pay'] = user_api()->user()->wallet;
                $data['online_pay'] = $data['total'] - user_api()->user()->wallet;
            }
        }else{
            $data['status'] = 'not_paid';
            $data['online_pay'] = $data['total'];
        }
        $order = Order::create($data);

        if ($request->coupon_id && $request->coupon_id != null){
            CouponUser::where(['user_id' => user_api()->user()->id, 'coupon_id' => $request->coupon_id])->update(['is_paid' => 'yes']);
            $order->update(['coupon_id'=>$request->coupon_id]);
        }
        foreach ($request->details as $detail) {
            $new_detail = new OrderDetails();
            $new_detail->order_id = $order->id;
            $new_detail->product_id = $detail['product_id'];
            $new_detail->amount = $detail['amount'];
            $new_detail->save();

            foreach ($detail['additions'] as $addition) {
                $new_addition = new OrderDetailsAdditions();
                $new_addition->details_id = $new_detail->id;
                $new_addition->addition_id = $addition['addition_id'];
                $new_addition->save();
            }
        }

//        $this->sendNotification(null, 'nuovo ordine ', 'nuovo ordine per te','admin');
//        $this->sendFCMNotification(null, 'nuovo ordine ', 'nuovo ordine per te','admin');

        $order = Order::where('id', $order->id)
            ->with($this->orderRelations())
            ->first();
        return $this->apiResponse($order,'','simple');
    }

    /*================================================*/
    public function current_orders(Request $request){

        $orders = Order::where('user_id',user_api()->user()->id)
            ->whereIn('status',['not_paid','new', 'accepted','in_market_way','wait_order','delivery'])
            ->with($this->orderRelations());

        return $this->apiResponse($orders);
    }
    /*================================================*/
    public function previous_orders(Request $request){

            $order = Order::where('user_id',user_api()->user()->id)
                ->whereIn('status',['canceled_from_market', 'canceled_from_delivery','canceled_from_admin','ended'])
                ->with($this->orderRelations());

        return $this->apiResponse($order);
    }
    /*================================================*/
    public function order_details(Request $request){
        $validator = Validator::make($request->all(),[
            'id'                    =>'required|exists:orders,id',
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
    public function rate_order(Request $request){
        $validator = Validator::make($request->all(),[
            'id'                => 'required|exists:orders,id',
            'delivery_rate'     => 'required',
            'market_rate'       => 'required',
        ]);
        if ($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),'simple','422');
        }

        $order = Order::where('id',$request->id)->with($this->orderRelations())->first();

        $rate_count =  Rate::where('order_id',$order->id)->count();
        if ($order->status == 'ended' && $rate_count == 0){
            $rate = Rate::create([
                'order_id' => $order->id,
                'market_rate' => $request->market_rate,
                'delivery_rate' => $request->delivery_rate,
            ]);
            return $this->apiResponse($rate,'','simple');
        }else{
            return $this->apiResponse(null,'cant rate ','simple',409);
        }

    }

    /*================================================*/
    public function support_order(Request $request){
        $data = $request->except('products');

        if ( $request->image && $request->image != null )
            $data['image'] = $this->saveImage($request->image,'uploads/support');

        $support = Support::create($data);

        foreach ($request->products as $product){
            SupportProducts::create([
                'support_id'=>$support->id,
                'product_id'=>$product['product_id'],
                'amount'=>$product['amount'],
            ]);
        }

        return $this->apiResponse($support,'','simple');


    }

}
