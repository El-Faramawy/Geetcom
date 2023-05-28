<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Http\Traits\WithRelationTrait;
use App\Models\Addition;
use App\Models\AdditionCategory;
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
    //==========================================================================
    public function market_all_data(Request $request){
//        return 1;
        $validator = Validator::make($request->all(),[
            'id'=>'required|exists:markets,id',
        ]);
        if ($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),'simple','422');
        }
        $market = Market::with($this->marketAllRelations())->where('id',$request->id)->first();
        foreach ($market->sub_categories as $sub_category){ // market_sub_category

            $products = $this->apiResponse(Product::with($this->productRelations())
                ->where(['sub_category_id'=> $sub_category->id,'market_id'=>$market->id]));
            $products_new_array = [];
            foreach ($products['data'] as $product){
                $add_arr = [];
                foreach ($product['product_additions_with_category'] as $add){
                    $add_arr[] = $add['addition_id'];
                }
                $category_ids = Addition::whereIn('id', $add_arr)
                    ->groupBy('addition_category_id')->pluck('addition_category_id');

                $categories = AdditionCategory::whereIn('id', $category_ids)->get();

                foreach ($categories as $category){
                    $category['additions'] = Addition::where('addition_category_id', $category->id)
                        ->whereIn('id', $add_arr)->get();
                }
//                return $categories;
                $product['categories'] = $categories;
                $products_new_array[] = $product;
            }
//            $sub_category['products'] = $products;
            $sub_category['products'] = $products_new_array;

        }
         $all_products =  $this->apiResponse(Product::with($this->productRelations())->where('market_id', $market->id));
        $all_products_new_array = [];
        foreach ($all_products['data'] as $product){
            $add_arr = [];
            foreach ($product['product_additions_with_category'] as $add){
                $add_arr[] = $add['addition_id'];
            }
            $category_ids = Addition::whereIn('id', $add_arr)
                ->groupBy('addition_category_id')->pluck('addition_category_id');

            $categories = AdditionCategory::whereIn('id', $category_ids)->get();

            foreach ($categories as $category){
                $category['additions'] = Addition::where('addition_category_id', $category->id)
                    ->whereIn('id', $add_arr)->get();
            }
            $product['categories'] = $categories;
            $all_products_new_array[] = $product;
        }

//        $market['all_products'] = $all_products;
        $market['all_products'] = $all_products_new_array;

        return $this->apiResponse($market,'','simple');
    }
}
