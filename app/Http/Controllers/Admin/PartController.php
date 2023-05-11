<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Part;
use App\Models\PartType;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class PartController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()){
            if ($request->brand_id && $request->brand_id != null)
                $parts =Part::where('brand_id',$request->brand_id)->latest()->get();
            else
                $parts =Part::latest()->get();
            return Datatables::of($parts)
                ->addColumn('action', function ($part) {
                    $action = '';
                    if (in_array(89, admin()->user()->permission_ids)) {
                        $action .= '
                        <button  id="editBtn" class="btn btn-default btn-primary btn-sm mb-2  mb-xl-0 "
                             data-id="' . $part->id . '" ><i class="fa fa-edit text-white"></i>
                        </button>';
                    }
                    if(in_array(90,admin()->user()->permission_ids)) {
                        $action .=  '
                             <a class="btn btn-default btn-danger btn-sm mb-2 mb-xl-0 delete"
                             data-id="' . $part->id . '" ><i class="fa fa-trash-o text-white"></i></a>
                       ';
                    }
                    return $action;
                })

                ->addColumn('category',function ($part){
                    return $part->brand->sub_category->category->name ?? '';
                })
                ->addColumn('sub_category',function ($part){
                    return $part->brand->sub_category->name ?? '';
                })
                ->addColumn('brand',function ($part){
                    return $part->brand->name ?? '';
                })
                ->editColumn('name',function ($part){
                    return $part->name_ar .'<br><span class="text-muted">'.$part->part_type->name.'</span>';
                })
                ->addColumn('checkbox' , function ($part){
                    return '<input type="checkbox" class="sub_chk" data-id="'.$part->id.'">';
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('Admin.Part.index',['brand_id'=>$request->brand_id ?? '']);
    }
    ################ Add Object #################
    public function create(Request $request )
    {
        $id = $request->id;
        if ($id){
            $brand = Brand::where('id',$id)->first();
            $brands = Brand::where('sub_category_id', $brand->sub_category_id)->get();
        }else{
            $brands = Brand::all();
        }
        $part_types = PartType::all();
        return view('Admin.Part.parts.create',compact('brands','part_types','id'))->render();
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
        Part::create($data);

        return response()->json(
            [
                'success' => 'true',
                'message' => 'تم الاضافة بنجاح'
            ]);
    }
    ################ Edit Part #################
    public function edit(Part $part)
    {
        $brands = Brand::where('sub_category_id', $part->brand->sub_category_id)->get();
        $part_types = PartType::all();
        return view('Admin.Part.parts.edit', compact('part','part_types','brands'));
    }
    ###############################################
    ################ update Part #################
    public function update(Request $request, Part $part)
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
        $part->update($data);

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
        Part::whereIn('id', $ids)->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }
    ################ Delete Part #################
    public function destroy(Part $part)
    {
        $part->delete();
        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }

}
