<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\PhotoTrait;
use App\Models\Category;
use App\Models\Slider;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class SliderController extends Controller
{
    use PhotoTrait;
    public function index(Request $request)
    {
        if ($request->ajax()){
            $sub_categories =Slider::latest()->get();
            return Datatables::of($sub_categories)
                ->addColumn('action', function ($slider) {
                    $action = '';
//                    if (in_array(81, admin()->user()->permission_ids)) {
                        $action .= '
                        <button  id="editBtn" class="btn btn-default btn-primary btn-sm mb-2  mb-xl-0 "
                             data-id="' . $slider->id . '" ><i class="fa fa-edit text-white"></i>
                        </button>';
//                    }
//                    if(in_array(82,admin()->user()->permission_ids)) {
                        $action .=  '
                             <a class="btn btn-default btn-danger btn-sm mb-2 mb-xl-0 delete"
                             data-id="' . $slider->id . '" ><i class="fa fa-trash-o text-white"></i></a>
                       ';
//                    }
                    return $action;
                })
                ->editColumn('image',function ($slider){
                    return '<img alt="image" class="img list-thumbnail border-0" style="width:100px;border-radius:10px" onclick="window.open(this.src)" src="'.$slider->image.'">';
                })
                ->addColumn('checkbox' , function ($slider){
                    return '<input type="checkbox" class="sub_chk" data-id="'.$slider->id.'">';
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('Admin.Slider.index');
    }
    ################ Add Object #################
    public function create()
    {
        return view('Admin.Slider.parts.create')->render();
    }

    public function store(Request $request)
    {
        $valedator = Validator::make($request->all(), [
            'image'=>'required',
        ]);

        if ($valedator->fails())
            return response()->json(['messages' => $valedator->errors()->getMessages(), 'success' => 'false']);

        $data = $request->all();
        if ($request->image && $request->image != null)
            $data['image']    = 'uploads/Slider/'.$this->saveImage($request->image,'uploads/Slider');
        Slider::create($data);

        return response()->json(
            [
                'success' => 'true',
                'message' => 'تم الاضافة بنجاح'
            ]);
    }
    ################ Edit Slider #################
    public function edit(Slider $slider)
    {
        return view('Admin.Slider.parts.edit', compact('slider'));
    }
    ###############################################
    ################ update Slider #################
    public function update(Request $request, Slider $slider)
    {
        $valedator = Validator::make($request->all(), [
            'image'=>'required',
        ]);
        if ($valedator->fails())
            return response()->json(['messages' => $valedator->errors()->getMessages(), 'success' => 'false']);

        $data = $request->all();
        if ($request->image && $request->image != null)
            $data['image']    = 'uploads/Slider/'.$this->saveImage($request->image,'uploads/Slider');
        $slider->update($data);

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
        Slider::whereIn('id', $ids)->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }
    ################ Delete Slider #################
    public function destroy(Slider $slider)
    {
        $slider->delete();
        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }

}
