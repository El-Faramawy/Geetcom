<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Http\Traits\WithRelationTrait;
use App\Models\Cart;
use App\Models\CartAddition;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    use WithRelationTrait , PaginateTrait;

    public function add_cart(Request $request){
        $validator = Validator::make($request->all(),[
            'product_id'    =>'required|exists:products,id',
            'amount'        =>'required',
        ]);
        if ($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),'simple','422');
        }

        if (Auth::guard('user_api')->user()->block == 'yes')
            return $this->apiResponse(null,'blocked','simple',411);

        $data = $request->except('amount','additions');
        $data['user_id']    = Auth::guard('user_api')->user()->id;
        $cart=Cart::updateOrCreate($data);
        $cart->amount = $request->amount;
        $cart->save();

        CartAddition::where('cart_id',$cart->id)->delete();
        foreach ($request['additions'] as $cart_addition){
            CartAddition::create([
                'cart_id'=>$cart->id,
                'addition_id'=>$cart_addition
            ]);
        }

        $cart = Cart::with($this->cartRelations())->where('id',$cart->id)->first();

        return $this->apiResponse($cart,'','simple');
    }

//==================================================================================

    public function delete_cart(Request $request){
        $validator = Validator::make($request->all(),[
            'id'    =>'required|exists:cart,id',
        ]);
        if ($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),'simple','422');
        }
        Cart::where('id',$request->id)->delete();
        return $this->apiResponse(null,'deleted successfully','simple');
    }
//==================================================================================

    public function get_cart(Request $request){
        $carts = Cart::with($this->cartRelations())
            ->where('user_id',Auth::guard('user_api')->user()->id);
        return $this->apiResponse($carts);
    }

}
