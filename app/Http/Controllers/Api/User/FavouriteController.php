<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Http\Traits\WithRelationTrait;
use App\Models\Favourate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FavouriteController extends Controller
{
    use WithRelationTrait, PaginateTrait;

    public function add_delete_favourite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'market_id' => 'exists:markets,id',
            'product_id' => 'exists:products,id',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 'simple', '422');
        }
        $data = $request->only('market_id', 'product_id');
        $data['user_id'] = user_api()->user()->id;
        $favourite = Favourate::where($data);
        if ($favourite->count()>0){
            $favourite->delete();
        }else{
            Favourate::create($data);
        }

        return $this->apiResponse(null, 'done', 'simple');
    }

//    //================================================================
//    public function delete_favourite(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//            'market_id' => 'exists:markets,id',
//            'product_id' => 'exists:products,id',
//        ]);
//        if ($validator->fails()) {
//            return $this->apiResponse(null, $validator->errors(), 'simple', '422');
//        }
//        $data = $request->only('market_id', 'product_id');
//        $data['user_id'] = user_api()->user()->id;
//        Favourate::where(['market_id'=>$request->market_id,'user_id'=>user_api()->user()->id])
//            ->orWhere(['product_id'=>$request->product_id,'user_id'=>user_api()->user()->id])->delete();
//
//        return $this->apiResponse(null, 'done', 'simple');
//    }

    //================================================================
    public function favourite_markets(Request $request)
    {
        $max_distance = setting()->num_of_kilos;
        $lat = $request['lat'];
        $lang = $request['lng'];
        $favourite = Favourate::with($this->favouriteRelations())
            ->whereHas('market',function ($query) use ($max_distance,$lat,$lang){
                $query->selectRaw('*, ( 3959 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance', [$lat, $lang, $lat])
                    ->orderBy('distance', 'asc')
                    ->where(['is_available'=>'yes'],['distance','<=',$max_distance]);
            })
            ->where('user_id', user_api()->user()->id);
//        $data = DB::table('markets')
//            ->selectRaw('*, ( 3959 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance', [$lat, $lang, $lat])
//            ->orderBy('distance', 'asc')
//            ->where(['is_available'=>'yes'],['distance','<=',$max_distance]);
        return $this->apiResponse($favourite);
    }

    //================================================================
    public function favourite_products(Request $request)
    {
        $favourite = Favourate::with($this->favouriteRelations())
            ->whereHas('product')
            ->where('user_id', user_api()->user()->id);
        return $this->apiResponse($favourite);
    }
}
