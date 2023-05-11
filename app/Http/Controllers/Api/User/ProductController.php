<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Http\Traits\WithRelationTrait;
use App\Models\Addition;
use App\Models\AdditionCategory;
use App\Models\Market;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    use WithRelationTrait , PaginateTrait;

    public function index(Request $request){
//        return 1;
        $validator = Validator::make($request->all(),[
            'id'=>'required|exists:products,id',
        ]);
        if ($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),'simple','422');
        }
        $product = Product::with($this->productRelations())->where('id',$request->id)->first();

        $product_additions = $product->product_additions_with_category->pluck('addition_id')->toArray();

        $category_ids = Addition::whereIn('id', $product_additions)
            ->groupBy('addition_category_id')->pluck('addition_category_id');

        $categories = AdditionCategory::whereIn('id', $category_ids)->get();

        foreach ($categories as $category){
            $category->additions = Addition::where('addition_category_id', $category->id)
                ->whereIn('id', $product_additions)->get();
        }
        $product->categories = $categories;

        return $this->apiResponse($product,'','simple');
    }

}
