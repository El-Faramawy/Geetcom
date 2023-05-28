<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdditionCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class AdditionCategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()){
            $additions =AdditionCategory::latest()->get();
            return Datatables::of($additions)
                ->addColumn('action', function ($addition) {
                    $action = '';
                    if (in_array(65, admin()->user()->permission_ids)) {
                        $action .= '
                        <button  id="editBtn" class="btn btn-default btn-primary btn-sm mb-2  mb-xl-0 "
                             data-id="' . $addition->id . '" ><i class="fa fa-edit text-white"></i>
                        </button>';
                    }
                    if(in_array(66,admin()->user()->permission_ids)) {
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
                ->editColumn('choise' , function ($addition){
                    return $addition->choise=='one'?'واحد ':'متعدد';
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('Admin.AdditionCategory.index');
    }
    ################ Add Object #################
    public function create()
    {
        return view('Admin.AdditionCategory.parts.create')->render();
    }

    public function store(Request $request)
    {
        $valedator = Validator::make($request->all(), [
            'name_ar'=>'required',
            'name_en'=>'required',
        ] );
        if ($valedator->fails())
            return response()->json(['messages' => $valedator->errors()->getMessages(), 'success' => 'false']);

        $data = $request->all();
        AdditionCategory::create($data);
        return response()->json(
            [
                'success' => 'true',
                'message' => 'تم الاضافة بنجاح'
            ]);
    }
    ################ Edit AdditionCategory #################
    public function edit(AdditionCategory $addition_category)
    {
        return view('Admin.AdditionCategory.parts.edit', compact('addition_category'));
    }

    ################ update Addition #################
    public function update(Request $request, AdditionCategory $addition_category)
    {
        $valedator = Validator::make($request->all(), [
            'name_ar'=>'required',
            'name_en'=>'required',
        ]);
        if ($valedator->fails())
            return response()->json(['messages' => $valedator->errors()->getMessages(), 'success' => 'false']);

        $data = $request->all();
        $addition_category->update($data);

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
        AdditionCategory::whereIn('id', $ids)->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }
    ################ Delete AdditionCategory #################
    public function destroy(AdditionCategory $addition_category)
    {
        $addition_category->delete();
        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }

}
