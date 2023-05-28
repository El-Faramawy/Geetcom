<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\PhotoTrait;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    use PhotoTrait;
    public function index(Request $request)
    {
        if ($request->ajax()){
            $categories =Category::latest()->get();
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
                ->editColumn('image',function ($category){
                    return '<img alt="image" class="img list-thumbnail border-0" style="width:100px;border-radius:10px" onclick="window.open(this.src)" src="'.$category->image.'">';
                })
                ->editColumn('featured',function ($item){
                    $color = $item->featured == "yes" ? "success" :"danger";
                    $text = $item->featured == "yes" ? "نعم" :"لا";
                    return '<span class="text-center fw-3 badge badge-sm badge-' . $color . '" style="color:white">'.$text.'</a>';
                })
                ->addColumn('checkbox' , function ($category){
                    return '<input type="checkbox" class="sub_chk" data-id="'.$category->id.'">';
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('Admin.Category.index');
    }
    ################ Add Object #################
    public function create()
    {
        return view('Admin.Category.parts.create')->render();
    }

    public function store(Request $request)
    {
        $valedator = Validator::make($request->all(), [
            'name_ar'=>'required',
            'name_en'=>'required',
            'image'=>'required',
        ]
//            ,
//            [
//                'name_ar.required' => 'الاسم بالعربية مطلوب',
//                'name_en.required' => 'الاسم بالانجليزية مطلوب',
//            ]
        );
        if ($valedator->fails())
            return response()->json(['messages' => $valedator->errors()->getMessages(), 'success' => 'false']);

        $data = $request->all();
        if (isset($request->image))
            $data['image']    = $this->saveImage($request->image,'uploads/Category');
        Category::create($data);

        return response()->json(
            [
                'success' => 'true',
                'message' => 'تم الاضافة بنجاح'
            ]);
    }
    ################ Edit offer #################
    public function edit(Category $category)
    {
        return view('Admin.Category.parts.edit', compact('category'));
    }
    ###############################################
    ################ update offer #################
    public function update(Request $request, Category $category)
    {
        $valedator = Validator::make($request->all(), [
            'name_ar'=>'required',
            'name_en'=>'required',
        ]
//            ,
//            [
//                'name_ar.required' => 'الاسم بالعربية مطلوب',
//                'name_en.required' => 'الاسم بالانجليزية مطلوب',
//            ]
        );
        if ($valedator->fails())
            return response()->json(['messages' => $valedator->errors()->getMessages(), 'success' => 'false']);

        $data = $request->all();
        if (isset($request->image))
            $data['image']    = $this->saveImage($request->image,'uploads/Category',$category->image);
        $category->update($data);

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
        Category::whereIn('id', $ids)->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }
    ################ Delete user #################
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }


}
