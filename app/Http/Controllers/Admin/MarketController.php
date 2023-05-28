<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\PhotoTrait;
use App\Models\Category;
use App\Models\Market;
use App\Models\MarketCategory;
use App\Models\MarketSubCategory;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class MarketController extends Controller
{
    use PhotoTrait;
    public function index(Request $request)
    {
        if ($request->ajax()){
            $data =Market::latest()->get();

            return Datatables::of($data)
                ->addColumn('action', function ($item) {
                    $action = '';
                    if(in_array(81,admin()->user()->permission_ids)){
                        $action .= '
                        <button  id="editBtn" class="btn btn-default btn-primary btn-sm mb-2  mb-xl-0 "
                             data-id="' . $item->id . '" ><i class="fa fa-edit text-white"></i>
                        </button>';
                    }
                    if(in_array(82,admin()->user()->permission_ids)) {
                        $action .= '<button class="btn btn-default btn-danger btn-sm mb-2 mb-xl-0 delete"
                             data-id="' . $item->id . '" ><i class="fa fa-trash-o text-white"></i>
                        </button>';
                    }
                    return $action;
                })
                ->addColumn('orders', function ($item) {
                    $order_data = '<a  class="btn btn-icon btn-bg-light btn-info btn-sm me-1 "
                            href="'.route("orders.index","market_id=".$item->id).'" >
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-shopping-basket "></i>
                                </span>
                            </span>
                            </button>';
                    return in_array(39,admin()->user()->permission_ids) ?$order_data :'';
                })
                ->addColumn('sub_categories', function ($item) {
                    $order_data = '<a  class="btn btn-icon btn-bg-light btn-info btn-sm me-1 "
                            href="'.route("sub_categories.index","market_id=".$item->id).'" >
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-database "></i>
                                </span>
                            </span>
                            </button>';
                    return in_array(60,admin()->user()->permission_ids) ?$order_data :'';
                })
                ->editColumn('image',function ($item){
                    return '<img alt="image" class="img list-thumbnail border-0" style="width:100px;border-radius:10px" onclick="window.open(this.src)" src="'.$item->image.'">';
                })
                ->editColumn('panner',function ($item){
                    return '<img alt="image" class="img list-thumbnail border-0" style="width:100px;border-radius:10px" onclick="window.open(this.src)" src="'.$item->panner.'">';
                })

                ->editColumn('block',function ($item){
                    $color = $item->block == "yes" ? "danger" :"dark";
                    $text = $item->block == "yes" ? "الغاء حظر" :"حظر";
                    $block =in_array(84,admin()->user()->permission_ids)? "block" : " ";
                    return '<a class="'. $block .' text-center fw-3  text-' . $color . '" data-id="' . $item->id . '" data-text="' . $text . '" style="cursor: pointer"><i class="py-2 fw-3  fa fa-ban text-' . $color . '" ></i></a>';
                })
                ->editColumn('is_available',function ($item){
                    $color = $item->is_available == "yes" ? "success" :"danger";
                    $text = $item->is_available == "yes" ? "فعال" :"غير فعال";
                    return '<span class="text-center fw-3 badge badge-sm badge-' . $color . '" style="color:white">'.$text.'</a>';
                })
                ->editColumn('delivery_period' , function ($item){
                    return 'من '.$item->min_from.' دقيقة <br> الى '.$item->min_to.' دقيقة';
                })
                ->editColumn('rating' , function ($item){
                    return $item->rating .' <i class="fa fa-star text-warning" ></i>';
                })
                ->addColumn('address', function ($item) {
                    $text = "الذهاب للعنوان";
                    return '<a href= "https://maps.google.com/?q='.$item->latitude.','.$item->longitude.'" target="_blank">'.$text.'</a>' ;
                })
                ->addColumn('checkbox' , function ($item){
                    return '<input type="checkbox" class="sub_chk" data-id="'.$item->id.'">';
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('Admin.Market.index');
    }
    ################ Add Object #################
    public function create()
    {
        $categories = Category::all();
        return view('Admin.Market.parts.create', compact( 'categories'))->render();
    }

    ###############################################
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_ar' => 'required',
            'location_ar' => 'required',
            'user_name' => 'required|unique:markets,user_name',
            'min_from' => 'required',
            'min_to' => 'required',
            'phone' => 'required',
            'price' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails())
            return response()->json(['messages' => $validator->errors()->getMessages(), 'success' => 'false']);

        $data = $request->except('categories','sub_categories');
        if (isset($request->password))
            $data['password'] = Hash::make($request->password);
        if (isset($request->image))
            $data['image']    = $this->saveImage($request->image,'uploads/Market');
        if (isset($request->panner))
            $data['panner']    = $this->saveImage($request->panner,'uploads/Market');

        $item = Market::create($data);
        if ($request->categories) {
            foreach ($request['categories'] as $category) {
                MarketCategory::create([
                    'market_id' => $item->id,
                    'category_id' => $category
                ]);
            }
        }

        if ($request->sub_categories) {
            foreach ($request['sub_categories'] as $sub_category) {
                MarketSubCategory::create([
                    'market_id' => $item->id,
                    'sub_category_id' => $sub_category
                ]);
            }
        }
        return response()->json(
            [
                'success' => 'true',
                'message' => 'تم الاضافة بنجاح'
            ]);
    }

    ################ Edit offer #################
    public function edit(Market $market)
    {
        $categories = Category::all();
        $category_ids = $market->market_category->pluck('category_id')->toArray();
        $sub_categories = SubCategory::whereIn('category_id',$category_ids)->get();
        $sub_category_ids = $market->market_sub_category->pluck('sub_category_id')->toArray();
        return view('Admin.Market.parts.edit',
            compact('categories','sub_categories', 'category_ids','sub_category_ids','market'));
    }

    ################ update offer #################
    public function update(Request $request, Market $market)
    {
        $validator = Validator::make($request->all(), [
            'name_ar' => 'required',
            'location_ar' => 'required',
            'user_name' => 'required|unique:markets,user_name,'.$market->id,
            'min_from' => 'required',
            'min_to' => 'required',
            'phone' => 'required',
            'price' => 'required',
        ]);
        if ($validator->fails())
            return response()->json(['messages' => $validator->errors()->getMessages(), 'success' => 'false']);

        $data = $request->except('categories','sub_categories');
        if (isset($request->password))
            $data['password'] = Hash::make($request->password);
        if (isset($request->image))
            $data['image']    = $this->saveImage($request->image,'uploads/Market',$market->image);
        if (isset($request->panner))
            $data['panner']    = $this->saveImage($request->panner,'uploads/Market',$market->panner);

        $market->update($data);
        MarketCategory::where('market_id',$market->id)->delete();
        if ($request->categories) {
            foreach ($request['categories'] as $category) {
                MarketCategory::create([
                    'market_id' => $market->id,
                    'category_id' => $category
                ]);
            }
        }
        MarketSubCategory::where('market_id',$market->id)->delete();
        if ($request->sub_categories) {
            foreach ($request['sub_categories'] as $sub_category) {
                MarketSubCategory::create([
                    'market_id' => $market->id,
                    'sub_category_id' => $sub_category
                ]);
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
        Market::whereIn('id', $ids)->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }
    ################ Delete Market #################
    public function destroy(Market $market)
    {
        $market->delete();
        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }
    ################ block Market #################
    public function block($id)
    {
        $user = Market::where('id',$id)->first();
        $text = $user->block == "yes" ? "تم الغاء الحظر بنجاح" :"تم الحظر بنجاح";
        $user->block = $user->block =='yes'?'no':'yes';
        $user->save();
        return response()->json(
            [
                'code' => 200,
                'message' => $text
            ]);
    }
//    ################ get_market_sub_categories #################
    public function get_market_sub_categories(Request $request)
    {

        $category_ids = explode(",", $request->category_ids);
        $sub_categories = SubCategory::whereIn('category_id', $category_ids)->get();
        $data = '<option value="" disabled>القسم</option>';

        if ($sub_categories){
            foreach($sub_categories as $sub_category){
                $data .=' <option value="'.$sub_category->id.'">'.$sub_category->name_ar.'</option>';
            }
        }

        return response()->json($data);
    }

}
