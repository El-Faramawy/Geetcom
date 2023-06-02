<?php

namespace App\Http\Traits;

trait WithRelationTrait
{
    /* Services */
//    private function ServiceRelations($user_id = null)
//    {
//        $ServiceWith =  [
//            'service_main_items',
//            'provider_obj',
//            'service_extra_items',
//            'service_images',
//            'offer',
//            'department',
//            /* service_rate */
//            'service_rate'=> function ($q) use ($user_id) {
//                return $q->where('user_id', $user_id);
//            },
//
//        ];
//        return $ServiceWith;
//    }

    /* ========================= products ============================*/
    /* products */
    private function productRelations()
    {
        return  ['category' , 'market','product_additions.addition','product_additions_with_category'/*,'product_additions_with_category.addition_with_category'*/];
    }
    /* ========================= sliders ============================*/
    /* sliders */
    private function sliderRelations()
    {
        return  ['product','market'];
    }
    /* ========================= category ============================*/
    /* category */
    private function categoryRelations()
    {
        return  ['market_category.market'/*,'products'*/];
    }
    /* ========================= category ============================*/
    /* category */
    private function marketRelations()
    {
        return  [/*'market_category.category'*/'market_sub_category.sub_category.products'];
    }
    /* ========================= category ============================*/
    /* category */
    private function marketAllRelations()
    {
//        return  ['market_sub_category.sub_category.products','products'/*,'products.product_additions.addition'*/];
        return  ['sub_categories.products'];
    }
    /* ========================= favouriteRelations ============================*/
    /* favouriteRelations */
    private function favouriteRelations()
    {
        return ['product','market'];
    }
    /* ========================= favouriteRelations ============================*/
    /* favouriteRelations */
    private function cartRelations()
    {
        return ['product','cart_additions.addition'];
    }
    /* ========================= orderRelations ============================*/
    /* order */
    private function orderRelations()
    {
        return [ 'order_details.product','order_details.additions.addition', 'coupon', 'address','delivery','user','market'];
    }
    /* ========================= chatRelations ============================*/
    /* chatRelations */
    private function chatRelations()
    {
        return ['user'];
    }




}//end class
