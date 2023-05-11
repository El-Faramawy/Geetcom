<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\PhotoTrait;
use App\Models\PartType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class PartTypeController extends Controller
{
    use PhotoTrait;
    public function index(Request $request)
    {
        if ($request->ajax()){
            $part_types =PartType::latest()->get();
            return Datatables::of($part_types)
                ->addColumn('action', function ($part_type) {
                    $action = '';
                    if (in_array(93, admin()->user()->permission_ids)) {
                        $action .= '
                        <button  id="editBtn" class="btn btn-default btn-primary btn-sm mb-2  mb-xl-0 "
                             data-id="' . $part_type->id . '" ><i class="fa fa-edit text-white"></i>
                        </button>';
                    }
                    if(in_array(94,admin()->user()->permission_ids)) {
                        $action .=  '
                             <a class="btn btn-default btn-danger btn-sm mb-2 mb-xl-0 delete"
                             data-id="' . $part_type->id . '" ><i class="fa fa-trash-o text-white"></i></a>
                       ';
                    }
                    return $action;
                })
                ->addColumn('checkbox' , function ($part_type){
                    return '<input type="checkbox" class="sub_chk" data-id="'.$part_type->id.'">';
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('Admin.PartType.index');
    }
    ################ Add Object #################
    public function create()
    {
        return view('Admin.PartType.parts.create')->render();
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
        if ($valedator->fails())
            return response()->json(['messages' => $valedator->errors()->getMessages(), 'success' => 'false']);

        PartType::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en
        ]);

        return response()->json(
            [
                'success' => 'true',
                'message' => 'تم الاضافة بنجاح'
            ]);
    }
    ################ Edit PartType #################
    public function edit(PartType $part_type)
    {
        return view('Admin.PartType.parts.edit', compact('part_type'));
    }
    ###############################################
    ################ update PartType #################
    public function update(Request $request, PartType $part_type)
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
        $part_type->update($data);

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
        PartType::whereIn('id', $ids)->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }
    ################ Delete PartType #################
    public function destroy(PartType $part_type)
    {
        $part_type->delete();
        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }


}
