<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DeliveryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()){
            $users =Delivery::latest()->get();

            return Datatables::of($users)
                ->addColumn('action', function ($user) {
                    if(in_array(7,admin()->user()->permission_ids)) {
                        return '
                             <a class="btn btn-default btn-danger btn-sm mb-2 mb-xl-0 delete"
                             data-id="' . $user->id . '" ><i class="fa fa-trash-o text-white"></i></a>
                       ';
                    }
                })
//                ->addColumn('orders', function ($user) {
//                    $order_data = '<a  class="btn btn-icon btn-bg-light btn-info btn-sm me-1 "
//                            href="'.route("orders.index","user_id=".$user->id).'" >
//                            <span class="svg-icon svg-icon-3">
//                                <span class="svg-icon svg-icon-3">
//                                    <i class="fa fa-shopping-basket "></i>
//                                </span>
//                            </span>
//                            </button>';
//                    return in_array(39,admin()->user()->permission_ids) ?$order_data :'';
//                })
                ->editColumn('image',function ($user){
                    return '<img alt="image" class="img list-thumbnail border-0" style="width:100px;border-radius:10px" onclick="window.open(this.src)" src="'.$user->image.'">';
                })
                ->editColumn('block',function ($user){
                    $color = $user->block == "yes" ? "danger" :"dark";
                    $text = $user->block == "yes" ? "الغاء حظر" :"حظر";
                    $block =in_array(10,admin()->user()->permission_ids)? "block" : " ";
                    return '<a class="'. $block .' text-center fw-3  text-' . $color . '" data-id="' . $user->id . '" data-text="' . $text . '" style="cursor: pointer"><i class="py-2 fw-3  fa fa-ban text-' . $color . '" ></i></a>';
                })
                ->addColumn('checkbox' , function ($user){
                    return '<input type="checkbox" class="sub_chk" data-id="'.$user->id.'">';
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('Admin.Delivery.index');
    }
    ################ multiple Delete  #################
    public function multiDelete(Request $request)
    {
        $ids = explode(",", $request->ids);
        Delivery::whereIn('id', $ids)->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }
    ################ Delete Delivery #################
    public function destroy(Delivery $delivery)
    {
        $delivery->delete();
        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }
    ################ block Delivery #################
    public function block($id)
    {
        $user = Delivery::where('id',$id)->first();
        $text = $user->block == "yes" ? "تم الغاء الحظر بنجاح" :"تم الحظر بنجاح";
        $user->block = $user->block =='yes'?'no':'yes';
        $user->save();
        return response()->json(
            [
                'code' => 200,
                'message' => $text
            ]);
    }


}
