<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Addition;
use App\Models\AdditionCategory;
use App\Models\AdditionProduct;
use App\Models\Category;
use App\Models\Market;
use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class AdditionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()){
            $additions =Addition::latest()->get();
            return Datatables::of($additions)
                ->addColumn('action', function ($addition) {
                    $action = '';
                    if (in_array(69, admin()->user()->permission_ids)) {
                        $action .= '
                        <button  id="editBtn" class="btn btn-default btn-primary btn-sm mb-2  mb-xl-0 "
                             data-id="' . $addition->id . '" ><i class="fa fa-edit text-white"></i>
                        </button>';
                    }
                    if(in_array(70,admin()->user()->permission_ids)) {
                        $action .=  '
                             <a class="btn btn-default btn-danger btn-sm mb-2 mb-xl-0 delete"
                             data-id="' . $addition->id . '" ><i class="fa fa-trash-o text-white"></i></a>
                       ';
                    }
                    return $action;
                })
                ->addColumn('checkbox' , function ($addition){
                    return '<input type="checkbox" class="sub_chk" data-id="'.$addition->id.'">';
                })
                ->addColumn('category' , function ($addition){
                    return $addition->category?$addition->category->name_ar : '' ;
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('Admin.Addition.index');
    }
    ################ Add Object #################
    public function create()
    {
//        $categories = Category::whereHas('products')->get();
        $markets = Market::whereHas('products')->get();
        $addition_categories = AdditionCategory::all();
        return view('Admin.Addition.parts.create',compact('markets','addition_categories'))->render();
    }

    public function store(Request $request)
    {
        $valedator = Validator::make($request->all(), [
            'name_ar'=>'required',
            'name_en'=>'required',
            'price'=>'required',
        ] );
        if ($valedator->fails())
            return response()->json(['messages' => $valedator->errors()->getMessages(), 'success' => 'false']);

        $data = $request->except('products');
        $addition = Addition::create($data);
        if ($request->products){
            foreach ($request['products'] as $product){
                AdditionProduct::create([
                    'addition_id'   => $addition->id,
                    'product_id'    => $product
                ]) ;
            }
        }
        return response()->json(
            [
                'success' => 'true',
                'message' => 'تم الاضافة بنجاح'
            ]);
    }
    ################ Edit Addition #################
    public function edit(Addition $addition)
    {
        $product_ids = $addition->product_additions->pluck('product_id')->toArray();
//        $categories = Category::whereHas('products')->get();
        $addition_categories = AdditionCategory::all();
        $markets = Market::whereHas('products')->get();

        return view('Admin.Addition.parts.edit',
            compact('addition','markets','addition_categories','product_ids'));
    }
    ################ update Addition #################
    public function update(Request $request, Addition $addition)
    {
        $valedator = Validator::make($request->all(), [
            'name_ar'=>'required',
            'name_en'=>'required',
            'price'=>'required',
        ]);
        if ($valedator->fails())
            return response()->json(['messages' => $valedator->errors()->getMessages(), 'success' => 'false']);

        $data = $request->except('products');
        $addition->update($data);
        AdditionProduct::where('addition_id',$addition->id)->delete();
        if ($request->products){
            foreach ($request['products'] as $product){
                AdditionProduct::create([
                    'addition_id'   => $addition->id,
                    'product_id'    => $product
                ]) ;
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
        Addition::whereIn('id', $ids)->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }
    ################ Delete user #################
    public function destroy(Addition $addition)
    {
        $addition->delete();
        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }

}
