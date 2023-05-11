<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Degree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class DegreeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()){
            $categories =Degree::latest()->get();
            return Datatables::of($categories)
                ->addColumn('action', function ($degree) {
                    $action = '';
                    if (in_array(61, admin()->user()->permission_ids)) {
                        $action .= '
                        <button  id="editBtn" class="btn btn-default btn-primary btn-sm mb-2  mb-xl-0 "
                             data-id="' . $degree->id . '" ><i class="fa fa-edit text-white"></i>
                        </button>';
                    }
                    if(in_array(62,admin()->user()->permission_ids)) {
                        $action .=  '
                             <a class="btn btn-default btn-danger btn-sm mb-2 mb-xl-0 delete"
                             data-id="' . $degree->id . '" ><i class="fa fa-trash-o text-white"></i></a>
                       ';
                    }
                    return $action;
                })

                ->addColumn('checkbox' , function ($degree){
                    return '<input type="checkbox" class="sub_chk" data-id="'.$degree->id.'">';
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('Admin.Degree.index');
    }
    ################ Add Object #################
    public function create()
    {
        return view('Admin.Degree.parts.create')->render();
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

        $data = $request->all();
        Degree::create($data);

        return response()->json(
            [
                'success' => 'true',
                'message' => 'تم الاضافة بنجاح'
            ]);
    }
    ################ Edit Degree #################
    public function edit(Degree $degree)
    {
        return view('Admin.Degree.parts.edit', compact('degree'));
    }
    ###############################################
    ################ update Degree #################
    public function update(Request $request, Degree $degree)
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
        $degree->update($data);

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
        Degree::whereIn('id', $ids)->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }
    ################ Delete user #################
    public function destroy(Degree $degree)
    {
        $degree->delete();
        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }

}
