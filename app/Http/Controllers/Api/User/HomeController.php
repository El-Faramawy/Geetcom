<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Http\Traits\WithRelationTrait;
use App\Models\Category;
use App\Models\Delivery;
use App\Models\Market;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
use WithRelationTrait , PaginateTrait;
    public function index(Request $request){
        $data =[];
        $slider = Slider::with($this->sliderRelations());
        $data['sliders'] = $this->apiResponse($slider);

        $offer = Product::offer()->with($this->productRelations());
        $data['offers'] = $this->apiResponse($offer);

        $lat = $request['lat'];
        $lang = $request['lng'];
        $max_distance = setting()->num_of_kilos;
//        $categories = Category::featured()->with('market_category')
//        ->whereHas('market_category',function ($q) use ($latitude,$longitude,$max_distance){
//            $q->whereHas('market',function ($q2) use ($latitude,$longitude,$max_distance){
//                $q2->selectRaw('latitude,longitude, ( 3959 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance', [$latitude, $longitude, $latitude])
//                    ->orderBy('distance', 'asc')
//                    ->where(['is_available'=>'yes',['distance','<=',$max_distance]]);
//            });
//        });
        $categories = Category::featured()->with('market_category')->whereHas('market_category')->get();
        foreach ($categories as $category){
//            return $category;
            $market_categorys = $category['market_category'];
            $market_ids = [];
            if ($market_categorys){
                foreach ($market_categorys as $market_category){
                    $market_ids[] = $market_category['market_id'];
                }
            }
//            $category['markets'] = Market::whereIn('id', $market_ids)
//                ->selectRaw('latitude,longitude, ( 3959 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance', [$latitude, $longitude, $latitude])
//                ->where(['is_available'=>'yes'])
//                ->where(['distance','<=',$max_distance])
//                ->orderBy('distance', 'asc')
//                ->get();
            $markets = DB::table('markets')->whereIn('id', $market_ids)
                    ->selectRaw('id, ( 3959 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance', [$lat, $lang, $lat])
                    ->orderBy('distance', 'asc')
                    ->where('is_available','yes')
////                    ->take(200)
                    //->select('latitude','longitude')
                    ->get();
            $mar = [];
            foreach ($markets as $market){
                if ($market->distance <= setting()->num_of_kilos){
                    $mar[] = Market::where('id', $market->id)->first();
                }
            }
            $category['markets'] = $mar;
        }
        $data['categories'] = $categories;

//        $all_markets = Market::query();
//        $data['all_markets'] = $this->paginate_case($all_markets);

        return $this->apiResponse($data,null,'simple');
    }
    //================================================================

    public function market_search(Request $request){
        $max_distance = setting()->num_of_kilos;
        $name = $request->name;
        $lat = $request['lat'];
        $lang = $request['lng'];
//        $data = Market::available()->where('name_ar','like','%' .$request->name. '%')
//           ->orWhere('name_en','like','%' .$request->name. '%');
        $markets = DB::table('markets')
            ->selectRaw('*, ( 3959 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance', [$lat, $lang, $lat])
            ->orderBy('distance', 'asc')
            ->where(['is_available'=>'yes'],['distance','<=',$max_distance])
            ->where(function ($query) use ($name){
                $query->where('name_ar','like','%' .$name. '%')
                    ->orWhere('name_en','like','%' .$name. '%');
            })->get();
        $mar = [];
        foreach ($markets as $market){
            if ($market->distance <= setting()->num_of_kilos){
                $mar[] = Market::where('id', $market->id)->first();
            }
        }

       return $this->apiResponse($mar,'','simple');
    }
    //================================================================
    public function get_delivery_data(Request $request){
        $validator = Validator::make($request->all(),[
            'id'=>'required',
        ]);
        if ($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),'simple','422');
        }
        $delivery = Delivery::where('id',$request->id)->select('latitude','longitude')->first();

        return $this->apiResponse($delivery,'','simple');
    }
    //================================================================
}
