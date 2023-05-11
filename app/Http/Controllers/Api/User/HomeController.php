<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Http\Traits\WithRelationTrait;
use App\Models\Category;
use App\Models\Market;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
use WithRelationTrait , PaginateTrait;
    public function index(){
        $data =[];
        $slider = Slider::with($this->sliderRelations());
        $data['sliders'] = $this->apiResponse($slider);

        $offer = Product::offer()->with($this->productRelations());
        $data['offers'] = $this->apiResponse($offer);

        $categories = Category::featured()->with($this->categoryRelations())
        ->whereHas('market_category',function ($q){
            $q->whereHas('market',function ($q2){
                $q2->where('is_available','yes');
            });
        });
        $data['categories'] = $this->apiResponse($categories);

//        $all_markets = Market::query();
//        $data['all_markets'] = $this->paginate_case($all_markets);

        return $this->apiResponse($data,null,'simple');
    }
    //================================================================

    public function market_search(Request $request){
       $data = Market::available()->where('name_ar','like','%' .$request->name. '%')
           ->orWhere('name_en','like','%' .$request->name. '%');
       return $this->apiResponse($data);
    }
    //================================================================
}
