<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()){
            if ($request->sub_category_id && $request->sub_category_id != null)
                $brands =Brand::where('sub_category_id',$request->sub_category_id)->latest()->get();
            else
                $brands =Brand::latest()->get();
            return Datatables::of($brands)
                ->addColumn('action', function ($brand) {
                    $action = '';
                    if (in_array(85, admin()->user()->permission_ids)) {
                        $action .= '
                        <button  id="editBtn" class="btn btn-default btn-primary btn-sm mb-2  mb-xl-0 "
                             data-id="' . $brand->id . '" ><i class="fa fa-edit text-white"></i>
                        </button>';
                    }
                    if(in_array(86,admin()->user()->permission_ids)) {
                        $action .=  '
                             <a class="btn btn-default btn-danger btn-sm mb-2 mb-xl-0 delete"
                             data-id="' . $brand->id . '" ><i class="fa fa-trash-o text-white"></i></a>
                       ';
                    }
                    return $action;
                })
                ->addColumn('parts', function ($brand) {
                    $data = '<a  class="btn btn-icon btn-bg-light btn-info btn-sm me-1 "
                            href="'.route("parts.index","brand_id=".$brand->id).'" >
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fe fe-menu side-menu__icon "></i>
                                </span>
                            </span>
                            </button>';
                    return in_array(88,admin()->user()->permission_ids) ?$data :'';
                })
                ->addColumn('category',function ($brand){
                    return $brand->sub_category->category->name ?? '';
                })
                ->addColumn('sub_category',function ($brand){
                    return $brand->sub_category->name ?? '';
                })
                ->addColumn('checkbox' , function ($brand){
                    return '<input type="checkbox" class="sub_chk" data-id="'.$brand->id.'">';
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('Admin.Brand.index',['sub_category_id'=>$request->sub_category_id ?? '']);
    }
    ################ Add Object #################
    public function create(Request $request )
    {
        $id = $request->id;
        if ($id){
            $sub_cat = SubCategory::where('id',$id)->first();
            $sub_categories = SubCategory::where('category_id', $sub_cat->category_id)->get();
        }else{
            $sub_categories = SubCategory::all();
        }

        return view('Admin.Brand.parts.create',compact('sub_categories','id'))->render();
    }

    public function store(Request $request)
    {
        $valedator = Validator::make($request->all(), [
            'name_ar'=>'required',
            'name_en'=>'required',
        ],
            [
                'name_ar.required' => 'الاسم بالعربية مطلوب',
                'name_en.required' => 'الاسم بالانجليزية مطلوب',
            ]
        );
//        return $request->all();
        if ($valedator->fails())
            return response()->json(['messages' => $valedator->errors()->getMessages(), 'success' => 'false']);

        $data = $request->all();
        Brand::create($data);

        return response()->json(
            [
                'success' => 'true',
                'message' => 'تم الاضافة بنجاح'
            ]);
    }
    ################ Edit Brand #################
    public function edit(Brand $brand)
    {
        $sub_categories = SubCategory::where('category_id', $brand->sub_category->category_id)->get();
        return view('Admin.Brand.parts.edit', compact('brand','sub_categories'));
    }
    ###############################################
    ################ update offer #################
    public function update(Request $request, Brand $brand)
    {
        $valedator = Validator::make($request->all(), [
            'name_ar'=>'required',
            'name_en'=>'required',
        ],
            [
                'name_ar.required' => 'الاسم بالعربية مطلوب',
                'name_en.required' => 'الاسم بالانجليزية مطلوب',
            ]
        );
        if ($valedator->fails())
            return response()->json(['messages' => $valedator->errors()->getMessages(), 'success' => 'false']);

        $data = $request->all();
        $brand->update($data);

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
        Brand::whereIn('id', $ids)->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }
    ################ Delete user #################
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }

}
