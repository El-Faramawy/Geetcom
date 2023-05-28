<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Http\Traits\WithRelationTrait;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    use WithRelationTrait, PaginateTrait;

    public function index(Request $request){
        $data = Address::where('user_id', user_api()->user()->id);
        return $this->apiResponse($data);
    }
    //================================================================================
    public function addAddress(Request $request){
        // validation
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'recipient_name'=>'required',
            'address'=>'required',
        ]);
        if ($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),'simple','422');
        }
        $data = $request->only('name','recipient_name','address','recipient_number','latitude','longitude');
        $data['user_id'] = user_api()->user()->id;
        $address = Address::create($data);

        return $this->apiResponse($address,'','simple');
    }
//    //================================================================================
//    public function editAddress(Request $request){
//        // validation
//        $validator = Validator::make($request->all(),[
//            'id'=>'required',
//            'name'=>'required',
//            'recipient_name'=>'required',
//            'address'=>'required',
//        ]);
//        if ($validator->fails()){
//            return $this->apiResponse(null,$validator->errors(),'422');
//        }
//        $data = $request->only('name','recipient_name','address','recipient_number','latitude','longitude');
//        $address = Address::where('id',$request->id)->first();
//        $address->update($data);
//
//        return $this->apiResponse($address);
//    }
    //================================================================================
    public function deleteAddress(Request $request){
        // validation
        $validator = Validator::make($request->all(),[
            'address_id'=>'required'
        ]);
        if ($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),'422');
        }
        Address::where('id',$request->address_id)->delete();

        return $this->apiResponse(null,'deleted successfully','simple');
    }
    //================================================================================

}
