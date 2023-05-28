<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\PhotoTrait;
use App\Models\Category;
use App\Models\Market;
use App\Models\MarketCategory;
use App\Models\MarketSubCategory;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    use PhotoTrait;

    public function index(Request $request)
    {
        if ($request->ajax()){
            $data =Product::where('sub_category_id',$request->sub_category_id)
                ->with('category','sub_category','market')->latest()->get();
            return Datatables::of($data)
                ->addColumn('action', function ($product) {
                    $action = '';
                    if (in_array(24, admin()->user()->permission_ids)) {
                        $action .= '
                        <button  id="editBtn" class="btn btn-default btn-primary btn-sm mb-2  mb-xl-0 "
                             data-id="' . $product->id . '" ><i class="fa fa-edit text-white"></i>
                        </button>';
                    }
                    if(in_array(25,admin()->user()->permission_ids)) {
                        $action .=  '
                             <a class="btn btn-default btn-danger btn-sm mb-2 mb-xl-0 delete"
                             data-id="' . $product->id . '" ><i class="fa fa-trash-o text-white"></i></a>
                       ';
                    }
                    return $action;
                })
                ->addColumn('checkbox' , function ($product){
                    return '<input type="checkbox" class="sub_chk" data-id="'.$product->id.'">';
                })
                ->addColumn('category' , function ($product){
                    return $product->category?$product->category->name_ar:'';
                })
                ->addColumn('sub_category' , function ($product){
                    return $product->sub_category?$product->sub_category->name_ar:'';
                })
                ->addColumn('market' , function ($product){
                    return $product->market?$product->market->name_ar:'';
                })
                ->editColumn('has_offer',function ($item){
                    $color = $item->has_offer == "yes" ? "success" :"danger";
                    $text = $item->has_offer == "yes" ? "نعم" :"لا";
                    return '<span class="text-center fw-3 badge badge-sm badge-' . $color . '" style="color:white">'.$text.'</a>';
                })
                ->editColumn('offer_type',function ($item){
                    if ( $item->has_offer == "no") return '';
                    $color = $item->offer_type == "value" ? "primary" :"info";
                    $text = $item->offer_type == "value" ? "قيمة" :"نسبة";
                    return '<span class="text-center fw-3 badge badge-sm badge-' . $color . '" style="color:white">'.$text.'</a>';
                })
                ->editColumn('value',function ($item){
                    if ( $item->has_offer == "no") return '';
                    return $item->offer_type == "value"?$item->value:'';
                })
                ->editColumn('percentage',function ($item){
                    if ( $item->has_offer == "no") return '';
                    return $item->offer_type == "percentage"?$item->percentage:'';
                })
                ->editColumn('old_price',function ($item){
                    if ( $item->has_offer == "no") return '';
                    return $item->old_price;
                })
                ->editColumn('image',function ($product){
                    return '<img alt="image" class="img list-thumbnail border-0" style="width:100px;border-radius:10px" onclick="window.open(this.src)" src="'.$product->image.'">';
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('Admin.Product.index',['id'=>$request->sub_category_id]);
    }
    ################ Add Object #################
    public function create(Request $request)
    {
        $sub_category = SubCategory::where('id',$request->id)->first();
        $sub_categories = SubCategory::all();
        $markets = Market::all();
        return view('Admin.Product.parts.create',compact('markets','sub_category','sub_categories'))->render();
    }

    public function store(Request $request)
    {
        $valedator = Validator::make($request->all(), [
//            'category_id'=>'required',
            'market_id'=>'required',
            'name_ar'=>'required',
            'name_en'=>'required',
            'description_ar'=>'required',
            'description_en'=>'required',
            'price'=>'required',
            'image'=>'required',
        ]);
        if ($valedator->fails())
            return response()->json(['messages' => $valedator->errors()->getMessages(), 'success' => 'false']);

        $data = $request->all();
        if (isset($request->image))
            $data['image']    = $this->saveImage($request->image,'uploads/product');

        Product::create($data);

        return response()->json(
            [
                'success' => 'true',
                'message' => 'تم الاضافة بنجاح'
            ]);
    }
    ################ Edit Product #################
    public function edit(Product $product)
    {
        $markets = Market::all();
        $market_categories = MarketCategory::with('category')->where('market_id', $product->market_id)->get();
        $market_sub_categories = MarketSubCategory::where('market_id', $product->market_id)
            ->pluck('sub_category_id')->toArray();
        $market_sub_categories = SubCategory::where('category_id', $product->category_id)->whereIn('id', $market_sub_categories)->get();
        $sub_categories = SubCategory::all();
        return view('Admin.Product.parts.edit', compact('product','markets','market_categories','market_sub_categories','sub_categories'));
    }
    ################ update Product #################
    public function update(Request $request, Product $product)
    {
        $valedator = Validator::make($request->all(), [
//            'category_id'=>'required',
            'market_id'=>'required',
            'name_ar'=>'required',
            'name_en'=>'required',
            'description_ar'=>'required',
            'description_en'=>'required',
            'price'=>'required',
//            'image'=>'required',
        ]);
        if ($valedator->fails())
            return response()->json(['messages' => $valedator->errors()->getMessages(), 'success' => 'false']);

        $data = $request->all();
        if ($request->image && $request->image != null)
            $data['image']    = $this->saveImage($request->image,'uploads/product',$product->image);
        $product->update($data);

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
        Product::whereIn('id', $ids)->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }
    ################ Delete user #################
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }
    ################ get_market_categories #################
    public function get_market_categories(Request $request)
    {
        $market_categories = MarketCategory::with('category')->where('market_id', $request->market_id)->get();
        $data = '<option value="" selected disabled>القسم</option>';
        if ($market_categories){
            foreach($market_categories as $category){
                $data .=' <option value="'.$category->category->id.'">'.$category->category->name_ar.'</option>';
            }
        }
        return response()->json($data);
    }   ################ get_market_sub_categories #################
    public function get_market_sub_categories(Request $request)
    {
        $market_sub_categories = MarketSubCategory::where('market_id', $request->market_id)
            ->pluck('sub_category_id')->toArray();
        $sub_categories = SubCategory::where('category_id', $request->category_id)->whereIn('id', $market_sub_categories)->get();
        $data = '<option value="" selected disabled> القسم الفرعى</option>';
        if ($sub_categories){
            foreach($sub_categories as $category){
                $data .=' <option value="'.$category->id.'">'.$category->name_ar.'</option>';
            }
        }
        return response()->json($data);
    }

}
