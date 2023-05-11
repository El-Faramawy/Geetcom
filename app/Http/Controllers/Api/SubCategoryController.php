<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    public function index(Request $request){
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
        ]);
        if ($validator->fails()) {
            return apiResponse(null, $validator->errors(), 422);
        }
        $category = Category::where('id',$request->category_id)->with('sub_categories')->first();;
        return apiResponse($category);
    }
    //================================================================

    public function sub_category_search(Request $request){
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
        ]);
        if ($validator->fails()) {
            return apiResponse(null, $validator->errors(), 422);
        }
        $name = $request->name;
        $data = SubCategory::where('category_id',$request->category_id)
            ->where(function ($query) use($name){
                $query->where('name_ar','like','%' .$name. '%')
                    ->orWhere('name_en','like','%' .$name. '%');
            })
            ->get();
        return apiResponse($data);
    }
    //================================================================
}
