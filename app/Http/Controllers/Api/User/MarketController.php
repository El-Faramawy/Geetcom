<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Http\Traits\WithRelationTrait;
use App\Models\Market;
use App\Models\MarketCategory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarketController extends Controller
{
    use WithRelationTrait , PaginateTrait;

    public function index(Request $request){
//        return 1;
        $validator = Validator::make($request->all(),[
            'id'=>'required|exists:markets,id',
        ]);
        if ($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),'simple','422');
        }
        $market = Market::with($this->marketRelations())->where('id',$request->id)->first();
        foreach ($market->market_category as $category){
            $category['products'] = $this->apiResponse(Product::where('category_id', $category->category_id));
        }
        $market['all_products'] = $this->apiResponse(Product::where('market_id', $market->id));
//        return 1;
        return $this->apiResponse($market,'','simple');
    }
}
