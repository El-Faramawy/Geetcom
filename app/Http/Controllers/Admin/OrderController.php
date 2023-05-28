<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\CanceledOrderTrait;
use App\Http\Traits\NotificationTrait;
use App\Http\Traits\WithRelationTrait;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Notification;

class OrderController extends Controller
{
     use NotificationTrait,WithRelationTrait,CanceledOrderTrait;


    public function orderStatus($order_status)
    {
        if ($order_status == 'accepted') {
            $status = 'مقبول';
            $color = 'primary';
        }
        elseif ($order_status == 'in_market_way') {
            $status = 'فى الطريق للمطعم';
            $color = 'primary';
        }
        elseif ($order_status == 'wait_order') {
            $status = 'فى انتظار الطلب';
            $color = 'primary';
        }
        elseif ($order_status == 'delivery') {
            $status = 'جارى التوصيل';
            $color = 'secondary';
        } elseif ($order_status === 'ended') {
            $status = 'منتهى';
            $color = 'success';
        } elseif ($order_status === 'not_paid') {
            $status = 'غير مدفوع';
            $color = 'info';
        } elseif ($order_status === 'canceled_from_market') {
            $status = 'ملغى من المطعم';
            $color = 'warning';
        } elseif ($order_status === 'canceled_from_delivery') {
            $status = 'ملغى من المندوب';
            $color = 'warning';
        } elseif ($order_status === 'canceled_from_admin') {
            $status = 'ملغى من الادارة';
            $color = 'warning';
        } else {
            $status = 'جديد';
            $color = 'info';
        }

        return ['status' => $status, 'color' => $color];
    }

//#################################################################
    public function index(Request $request )
    {
        $id = null;
        if ($request->user_id){
            $id = $request->user_id;
        }elseif ($request->delivery_id){
            $id = $request->delivery_id;
        }elseif ($request->market_id){
            $id = $request->market_id;
        }

        if ($request->ajax()) {
            $order_from = $request->order_from ? date('Y-m-d', strtotime($request->order_from)) : date('1970-1-1');
            $order_to = $request->order_to ? date('Y-m-d', strtotime($request->order_to)) : date('Y-m-d', strtotime('+1 year'));
            $status = $request->status != null ? [$request->status] : [ 'new','not_paid', 'accepted','in_market_way','wait_order','delivery', 'ended', 'canceled_from_market','canceled_from_delivery', 'canceled_from_admin'] ;
            $status = $request->status == 'all' ? [ 'new','not_paid', 'accepted','in_market_way','wait_order','delivery', 'ended', 'canceled_from_market','canceled_from_delivery', 'canceled_from_admin'] : $status;

            if ($request->user_id){
                $orders = Order::where('user_id',$request->user_id)
                    ->with($this->orderRelations() )
                    ->whereIn('status', $status)
                    ->whereBetween('created_at', [$order_from, $order_to])
                    ->orderBy('created_at', 'desc')->get();
            }elseif ($request->delivery_id){
                $orders = Order::where('delivery_id',$request->delivery_id)
                    ->with($this->orderRelations() )
                    ->whereIn('status', $status)
                    ->whereBetween('created_at', [$order_from, $order_to])
                    ->orderBy('created_at', 'desc')->get();
            }elseif ($request->market_id){
                $orders = Order::where('market_id',$request->market_id)
                    ->with($this->orderRelations() )
                    ->whereIn('status', $status)
                    ->whereBetween('created_at', [$order_from, $order_to])
                    ->orderBy('created_at', 'desc')->get();
            }else{
                $orders = Order::whereHas('user')
                    ->with($this->orderRelations() )
                    ->whereIn('status', $status)
                    ->whereBetween('created_at', [$order_from, $order_to])
                    ->orderBy('created_at', 'desc')->get();
            }
//            return $orders;
            return Datatables::of($orders)
                ->addColumn('action', function ($order) {
                    if (in_array(40, admin()->user()->permission_ids)) {
                        return '
                            <button class="btn btn-default btn-danger btn-sm mb-2 mb-xl-0 delete"
                                 data-id="' . $order->id . '" ><i class="fa fa-trash-o text-white"></i>
                            </button>
                       ';
                    }

                })
                ->editColumn('status', function ($order) {
                    $order_status = $this->orderStatus($order->status);
                    $statusBtn = in_array(41, admin()->user()->permission_ids) ? "statusBtn" : " ";
                    $button = '<div class="card-options pr-0">
                                    <a class="btn btn-sm ' . $statusBtn . '" style="background-color: #0ea5b9;color: white" href="' . route("change_order_status", $order->id) . '"><i class="fa fa-pencil mb-0"></i></a>
                                </div>';
                    return '
                            <div class="card-header pt-0  pb-0 border-bottom-0">
                            <a  class="badge badge-' . $order_status['color'] . ' text-white ">' . $order_status['status'] . '</a>
                                ' . $button . '
                            </div>
							';
                })
                ->addColumn('details', function ($order) {
                    return '<div class="card-options pr-2">
                                    <a class="btn btn-sm btn-primary text-white statusBtn"  href="' . route("order_details", $order->id) . '"><i class="fa fa-book mb-0"></i></a>
                           </div>';
                })
                ->addColumn('print', function ($order) {
                    return '<div class="card-options pr-0">
                                    <a class="btn btn-sm btn-success copyBtn" style="color: white" href="' . route("order_copy", $order->id) . '"><i class="fa fa-print mb-0"></i></a>
                                </div>
                           ';
                })
                ->editColumn('created_at', function ($order) {
                    return date('d-m-Y', strtotime($order->created_at)) ;
                })
                ->addColumn('delivery', function ($order) {
                    return $order->delivery?$order->delivery->name : '';
                })
                ->addColumn('coupon', function ($order) {
                    return $order->coupon?$order->coupon->code :'';
                })
                ->addColumn('address', function ($order) {
                    if (!$order->address)return '';
                    $text = "الذهاب للعنوان";
                    return $order->address->address .
                        '<br><a href= "https://maps.google.com/?q='.$order->address->latitude.','.$order->address->longitude.'" target="_blank">'.$text.'</a>' ;
                })
                ->addColumn('market', function ($order) {
                    return $order->market?$order->market->name_ar:'' ;
                })
                ->editColumn('created_at', function ($order) {
                    return date('Y-m',strtotime($order->created_at)).'<br>'. date('h:i A',strtotime($order->created_at)) ;
                })
                ->addColumn('user', function ($order) {
                    return $order->user?$order->user->name : '';
                })->editColumn('pay_type', function ($order) {
                    return $order->pay_type =='wallet'?'<b class="text-primary">المحفظة</b>'
                        :'<b class="text-success">الكترونى</b>';
                })->editColumn('delivery_period' , function ($order){
                    return 'من '.date('h:i A',strtotime($order->from)).' <br> الى '.date('h:i A',strtotime($order->to));
                })->addColumn('checkbox', function ($order) {
                    return '<input type="checkbox" class="sub_chk" data-id="' . $order->id . '">';
                })
                ->escapeColumns([])
                ->make(true);
        }

        return view('Admin.Order.index',['id'=>$id ]);
    }

//#################################################################

    ################ multiple Delete  #################
    public function multiDelete(Request $request)
    {
        $ids = explode(",", $request->ids);
        Order::whereIn('id', $ids)->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'Eliminato con successo'
            ]);
    }


    ################ Delete Order #################
    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(
            [
                'code' => 200,
                'message' => 'Eliminato con successo'
            ]);
    }

    ################ change_order_status #################
    public function change_order_status($id)
    {
//        $order = Order::where('id', $id)->select('id','delivery_id','status')->first();
//        $deliveries = Delivery::where('block','no')->get();
        return view('Admin.Order.parts.status', compact('id'))->render();
    }

    ################ change_order_status #################
    public function update_order_status(Request $request)
    {
        $order = Order::where('id', $request->id)->first();
        $order->update(['status' => $request->status]);

        if (in_array($order->status,['canceled_from_market','canceled_from_delivery', 'canceled_from_admin']) ) {
            $this->cancelOrder($order);

        }

        $this->sendAllNotifications([$order->user_id], 'تم تغيير حالة الطلب', $this->orderStatus($order->status)["status"].'الى  '.$order->id.'تم تغيير حالة الطلب رقم ');
        if ($order->delivery_id != null) {
            $this->sendAllNotifications([$order->delivery_id], 'تم تغيير حالة الطلب', $this->orderStatus($order->status)["status"].'الى  '.$order->id.'تم تغيير حالة الطلب رقم ','delivery');
        }
        if ($order->market_id != null) {
            $this->sendAllNotifications([$order->market_id], 'تم تغيير حالة الطلب', $this->orderStatus($order->status)["status"].'الى  '.$order->id.'تم تغيير حالة الطلب رقم ','market');
        }

        return response()->json(
            [
                'success' => 'true',
                'message' => 'تم تغيير حالة الطلب بنجاح '
            ]);
    }

    ################ order_details #################
    public function order_details($id)
    {
        $order = Order::with('order_details')->where('id', $id)->first();
        return view('Admin.Order.parts.details', compact('order'))->render();
    }
    ################ order_copy #################
    public function order_copy($id)
    {
        $order = Order::where('id', $id)
            ->with( 'order_details.product','order_details.additions.addition', 'coupon', 'address', 'delivery', 'market','user')
            ->first();
        foreach ($order->order_details as $detail){
            $detail->price = 0;
            foreach ($detail->additions as $addition){
                $detail->price += $addition->addition->price;
            }
            $detail->price += $detail->product ? $detail->product->price : 0;
            $detail->sub_total = $detail->price*$detail->amount;
        }
        return view('Admin.Order.parts.invoice', compact('order'))->render();
    }
//    ##############################################
//
//    public function order_data()
//    {
//        $new_order = Order::where(['checked' => 0])->count();
//        Order::where(['checked' => 0])->update(['checked'=>1]);
//        return response()->json([
//            'success' => 1,
//            'data' =>  $new_order
//        ]);
//    }
}
