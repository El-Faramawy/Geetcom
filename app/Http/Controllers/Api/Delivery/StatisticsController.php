<?php

namespace App\Http\Controllers\Api\Delivery;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Http\Traits\WithRelationTrait;
use App\Models\Order;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    use WithRelationTrait , PaginateTrait;
    public function index(Request $request){
        $data =[];

        for($i =0;$i <= 9;$i++){
            $data[$i]['order_number'] = Order::where(['delivery_id'=>delivery_api()->user()->id , 'status'=>'ended'])
                ->whereDate('created_at',date('Y-m-d',strtotime('-'.$i.' day')) )->count();
            $data[$i]['date'] = date('Y-m-d',strtotime('-'.$i.' day'));
        }

        return $this->apiResponse($data,null,'simple');
    }
    //================================================================

}
