<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Http\Traits\WithRelationTrait;
use App\Models\Category;
use App\Models\Market;
use App\Models\MarketCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    use WithRelationTrait , PaginateTrait;

    public function index(){
        $categories = Category::with($this->categoryRelations());
        return $this->apiResponse($categories);
    }
    //================================================
    public function category_markets(Request $request){
        $validator = Validator::make($request->all(),[
            'category_id'=>'required|exists:categories,id',
        ]);
        if ($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),'simple','422');
        }
        $market_ids = MarketCategory::where('category_id',$request->category_id)->pluck('market_id')->toArray();
        $markets = Market::available()->whereIn('id',$market_ids);
        return $this->apiResponse($markets);
    }
    //================================================
}
