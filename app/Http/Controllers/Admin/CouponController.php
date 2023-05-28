<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\NotificationTrait;
use App\Models\Coupon;
use App\Models\CouponUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class CouponController extends Controller
{
    use NotificationTrait;
    public function index(Request $request)
    {
        if ($request->ajax()){
            $data =Coupon::latest()->get();
            return Datatables::of($data)
                ->addColumn('action', function ($item) {
                    $action = '';
                    if (in_array(77, admin()->user()->permission_ids)) {
                    $action .= '
                        <button  id="editBtn" class="btn btn-default btn-primary btn-sm mb-2  mb-xl-0 "
                             data-id="' . $item->id . '" ><i class="fa fa-edit text-white"></i>
                        </button>';
                    }
                    if(in_array(78,admin()->user()->permission_ids)) {
                    $action .=  '
                             <a class="btn btn-default btn-danger btn-sm mb-2 mb-xl-0 delete"
                             data-id="' . $item->id . '" ><i class="fa fa-trash-o text-white"></i></a>
                       ';
                    }
                    return $action;
                })
                ->addColumn('checkbox' , function ($item){
                    return '<input type="checkbox" class="sub_chk" data-id="'.$item->id.'">';
                })
                ->editColumn('coupon_on',function ($item){
                    $color = $item->coupon_on == "points" ? "success" :"danger";
                    $text = $item->coupon_on == "points" ? "نقاط" :"مشتريات";
                    return '<span class="text-center fw-3 badge badge-sm badge-' . $color . '" style="color:white">'.$text.'</a>';
                })
                ->editColumn('type',function ($item){
                    $color = $item->offer_type == "value" ? "primary" :"info";
                    $text = $item->offer_type == "value" ? "قيمة" :"نسبة";
                    return '<span class="text-center fw-3 badge badge-sm badge-' . $color . '" style="color:white">'.$text.'</a>';
                })
                ->editColumn('is_available',function ($item){
                    $color = $item->is_available == "yes" ? "success" :"danger";
                    $text = $item->is_available == "yes" ? "متاح" :"غير متاح";
                    return '<span class="text-center fw-3 badge badge-sm badge-' . $color . '" style="color:white">'.$text.'</a>';
                })
                ->editColumn('value',function ($item){
                    return $item->type == "value"?$item->value:'';
                })
                ->editColumn('percentage',function ($item){
                    return $item->type == "percentage"?$item->percentage:'';
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('Admin.Coupon.index');
    }
    ################ Add Object #################
    public function create()
    {
        $users = User::where(['block'=>'no'])->get();
        return view('Admin.Coupon.parts.create',compact('users'))->render();
    }

    public function store(Request $request)
    {
        $valedator = Validator::make($request->all(), [
            'code' => 'required|unique:coupons,code',
        ]);
        if ($valedator->fails())
            return response()->json(['messages' => $valedator->errors()->getMessages(), 'success' => 'false']);

        $data = $request->except('users');
        $request->type == 'value'?$data['percentage'] = $data['max_price'] = null : $data['value'] = $data['min_price'] = null;
        $coupon = Coupon::create($data);

        if ($request->users){
            foreach ($request['users'] as $user){
                CouponUser::create([
                    'coupon_id'   => $coupon->id,
                    'user_id'      => $user
                ]) ;
            }
            $this->sendAllNotifications($request->users, 'كوبون جديد', ($coupon->coupon_on=='points'?'نقاط':' مشتريات ').'تم اضافة كوبون ');
        }
        return response()->json(
            [
                'success' => 'true',
                'message' => 'تم الاضافة بنجاح'
            ]);
    }
    ################ Edit Coupon #################
    public function edit(Coupon $coupon)
    {
        $users = User::where(['block'=>'no'])->get();
        $user_ids = $coupon->coupon_users->pluck('user_id')->toArray();
        $coupon_paid_users = CouponUser::where(['coupon_id'=>$coupon->id,'is_paid'=>'yes'])->pluck('user_id')->toArray();
//        return $user_ids;
        return view('Admin.Coupon.parts.edit', compact('coupon','users','coupon_paid_users','user_ids'));
    }
    ################ update Product #################
    public function update(Request $request, Coupon $coupon)
    {
        $valedator = Validator::make($request->all(), [
            'code' => 'required|unique:coupons,code,'.$coupon->id,
        ]);
        if ($valedator->fails())
            return response()->json(['messages' => $valedator->errors()->getMessages(), 'success' => 'false']);

        $data = $request->except('users');
        $request->type == 'value'?$data['percentage'] = $data['max_price'] = null : $data['value'] = $data['min_price'] = null;
        $coupon->update($data);
        $old_users = CouponUser::where('coupon_id', $coupon->id)->pluck('user_id')->toArray();
//        return $old_users;
        CouponUser::where('coupon_id', $coupon->id)->delete();
        if ($request->users) {
            foreach ($request['users'] as $user) {
                CouponUser::create([
                    'coupon_id' => $coupon->id,
                    'user_id' => $user
                ]);
//                if (!in_array($user, $old_users)) {
//                    $this->sendNotification([$user], 'nuovo tagliando ', 'nuovo coupon disponibile per te ' . ($coupon->percentage ? $coupon->percentage . ' % ' : $coupon->value . ' CHF ') . 'con minimo ' . $coupon->min_price . ' con massimo ' . $coupon->max_price .' codice ' . $coupon->code);
//                    $this->sendFCMNotification([$user], 'nuovo tagliando ', 'nuovo coupon disponibile per te ' . ($coupon->percentage ? $coupon->percentage . ' % ' : $coupon->value . ' CHF ') . 'con minimo ' . $coupon->min_price . ' con massimo ' . $coupon->max_price.' codice ' . $coupon->code);
//                    $this->sendAllNotifications([$user], 'كوبون جديد', ($coupon->coupon_on=='points'?'نقاط':' مشتريات ').'تم اضافة كوبون ');
//                }
            }
        }


        return response()->json(
            [
                'success' => 'true',
                'message' => 'تم التعديل بنجاح '
            ]);
    }

    ################ multiple Delete  #################
    public function multiDelete(Request $request)
    {
        $ids = explode(",", $request->ids);
        Coupon::whereIn('id', $ids)->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }
    ################ Delete Coupon #################
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }

}
