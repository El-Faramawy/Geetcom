<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Http\Traits\WithRelationTrait;
use App\Models\Favourate;
use Illuminate\Http\Request;
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
        $favourite = Favourate::with($this->favouriteRelations())
            ->whereHas('market')
            ->where('user_id', user_api()->user()->id);
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
