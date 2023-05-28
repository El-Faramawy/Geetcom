<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Support;
use App\Models\SupportProducts;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SupportController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()){
            $supports =Support::withCount('support_products')->latest()->get();
            return Datatables::of($supports)
                ->addColumn('action', function ($item) {
                    $action = '';
                    if(in_array(86,admin()->user()->permission_ids)) {
                        $action .=  '
                             <a class="btn btn-default btn-danger btn-sm mb-2 mb-xl-0 delete"
                             data-id="' . $item->id . '" ><i class="fa fa-trash-o text-white"></i></a>
                       ';
                    }
                    return $action;
                })
                ->editColumn('image',function ($item){
                    return '<img alt="image" class="img list-thumbnail border-0" style="width:100px;border-radius:10px" onclick="window.open(this.src)" src="'.$item->image.'">';
                })
                ->addColumn('details', function ($item) {
                    if ($item->support_products_count==0) return '';
                    return '<div class="card-options pr-2">
                                    <a class="btn btn-sm btn-primary text-white statusBtn"  href="' . route("support_details", $item->id) . '"><i class="fa fa-book mb-0"></i></a>
                           </div>';
                })
                ->addColumn('checkbox' , function ($item){
                    return '<input type="checkbox" class="sub_chk" data-id="'.$item->id.'">';
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('Admin.Support.index');
    }
################ multiple Delete  #################
    public function multiDelete(Request $request)
    {
        $ids = explode(",", $request->ids);
        Support::whereIn('id', $ids)->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }
    ################ Delete user #################
    public function destroy(Support $support)
    {
        $support->delete();
        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }
    ################ support_details #################
    public function support_details($id)
    {
        $products = SupportProducts::with('product')->where('support_id', $id)->get();
        return view('Admin.Support.parts.details', compact('products'))->render();
    }
}
