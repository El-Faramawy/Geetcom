<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Market;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class SubCategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()){
//            $categories =SubCategory::with('category')->latest()->get();
            $categories =SubCategory::with('category')
                ->where('market_id',$request->market_id)->latest()->get();
            return Datatables::of($categories)
                ->addColumn('action', function ($category) {
                    $action = '';
                    if (in_array(61, admin()->user()->permission_ids)) {
                        $action .= '
                        <button  id="editBtn" class="btn btn-default btn-primary btn-sm mb-2  mb-xl-0 "
                             data-id="' . $category->id . '" ><i class="fa fa-edit text-white"></i>
                        </button>';
                    }
                    if(in_array(62,admin()->user()->permission_ids)) {
                        $action .=  '
                             <a class="btn btn-default btn-danger btn-sm mb-2 mb-xl-0 delete"
                             data-id="' . $category->id . '" ><i class="fa fa-trash-o text-white"></i></a>
                       ';
                    }
                    return $action;
                })
//                ->editColumn('category',function ($item){
//                    return $item->category ? $item->category->name_ar : '';
//                })
                ->editColumn('market',function ($item){
                    return $item->market ? $item->market->name_ar : '';
                })
                ->addColumn('products', function ($item) {
                    $order_data = '<a  class="btn btn-icon btn-bg-light btn-info btn-sm me-1 "
                            href="'.route("products.index","sub_category_id=".$item->id).'" >
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-database "></i>
                                </span>
                            </span>
                            </button>';
                    return in_array(23,admin()->user()->permission_ids) ?$order_data :'';
                })
                ->addColumn('checkbox' , function ($category){
                    return '<input type="checkbox" class="sub_chk" data-id="'.$category->id.'">';
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('Admin.SubCategory.index',['id'=>$request->market_id?:'']);
    }
    ################ Add Object #################
    public function create(Request $request)
    {
        $market_id = $request->id;
//        $categories = Category::all();
        $markets = Market::all();
        return view('Admin.SubCategory.parts.create',compact('markets','market_id'))->render();
    }

    public function store(Request $request)
    {
        $valedator = Validator::make($request->all(), [
//                'category_id'=>'required',
                'market_id'=>'required',
                'name_ar'=>'required',
                'name_en'=>'required',
            ]
        );
        if ($valedator->fails())
            return response()->json(['messages' => $valedator->errors()->getMessages(), 'success' => 'false']);

        $data = $request->all();
        SubCategory::create($data);

        return response()->json(
            [
                'success' => 'true',
                'message' => 'تم الاضافة بنجاح'
            ]);
    }
    ################ Edit Object #################
    public function edit(SubCategory $sub_category)
    {
//        $categories = Category::all();
        $markets = Market::all();
        return view('Admin.SubCategory.parts.edit', compact('markets','sub_category'));
    }
    ###############################################
    ################ update offer #################
    public function update(Request $request, SubCategory $sub_category)
    {
        $valedator = Validator::make($request->all(), [
//                'category_id'=>'required',
                'market_id'=>'required',
                'name_ar'=>'required',
                'name_en'=>'required',
            ]
        );
        if ($valedator->fails())
            return response()->json(['messages' => $valedator->errors()->getMessages(), 'success' => 'false']);

        $data = $request->all();
        $sub_category->update($data);

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
        SubCategory::whereIn('id', $ids)->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }
    ################ Delete user #################
    public function destroy(SubCategory $sub_category)
    {
        $sub_category->delete();
        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }

}
