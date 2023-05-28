<?php

namespace App\Http\Controllers\Api\Delivery;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarketsController extends Controller
{
    use PaginateTrait;
    public function index(Request $request){
        $page = $request['page'];
        $skip = ($page-1)*200;

        $lat = $request['lat'];
        $lang = $request['lng'];
        $markets = DB::table('markets')
            ->selectRaw('latitude,longitude, ( 3959 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance', [$lat, $lang, $lat])
            ->orderBy('distance', 'asc')->skip($skip)
            ->take(200)
            //->select('latitude','longitude')
            ->get();
//            ->limit(200)->select('latitude', 'longitude');
        return response()->json(['code'=>200,'data'=>$markets]);
//        return $markets;
//        return $this->apiResponse($markets,'','simple');
    }
}
