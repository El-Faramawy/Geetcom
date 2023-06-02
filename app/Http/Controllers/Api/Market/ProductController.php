<?php

namespace App\Http\Controllers\Api\Market;

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

    //================================================================================
    public function products(Request $request){

//        $market = Market::with($this->marketRelations())->where('id',market_api()->user()->id)->first();
        $market = Market::with($this->marketAllRelations())->where('id',market_api()->user()->id)->first();
        $cats = [];
        foreach ($market->sub_categories as $category){
            $products = $this->apiResponse($category->products());
//            $category['products'] = $this->apiResponse($category->products());
            $products_new_array = [];
            foreach ($products['data'] as $product){
                $add_arr = [];
                foreach ($product['product_additions_with_category'] as $add){
                    $add_arr[] = $add['addition_id'];
                }
                $category_ids = Addition::whereIn('id', $add_arr)
                    ->groupBy('addition_category_id')->pluck('addition_category_id');
                $categories = AdditionCategory::whereIn('id', $category_ids)->get();

                foreach ($categories as $category_){
                    $category_['additions'] = Addition::where('addition_category_id', $category_->id)
                        ->whereIn('id', $add_arr)->get();
                }
                $product['categories'] = $categories;
                $products_new_array[] = $product;
            }

            $category['products'] = $products_new_array;
        }
        return $this->apiResponse($market,'','simple');
    }
    //================================================================================
    public function offers(Request $request){
        $offers = Product::offer()->where('market_id', market_api()->user()->id);
        $offers = $this->apiResponse($offers);
        $products_new_array = [];
        foreach ($offers['data'] as $product){
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
            $products_new_array[] = $product;
        }

        return $products_new_array;
    }



}
