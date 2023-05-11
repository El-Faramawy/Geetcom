<?php

namespace App\Http\Traits;

Trait  PaginateTrait
{
//    //===================  apiResponse ===========================
//    private function simpleApiResponse($data = null,$message = '',$code = 200,$status = '200') {
//        return response()->json(['data'=>$data,'message'=>$message,'code'=>intval($code)],$status);
//    }

    //===================  ApiResponse ===========================
    private function apiResponse($object = '',$message = '',$type='object',$code =200,$status = '200')
    {
        if ($type=='simple'){
            return response()->json(['data'=>$object,'message'=>$message,'code'=>intval($code)],$status);
        }
        $pagination_status = request()->get('pagination_status');
        $per_link_ = request()->get('records_number');
        $orderBy = request()->get('orderBy');

        if (!isset($orderBy) || !in_array($orderBy, ['asc', 'desc'])) {
            $orderBy = 'desc';
        }

        $data = $object->orderBy('id', $orderBy)->get();

        if ($pagination_status == 'on') {
            if ($per_link_ != '' && is_numeric($per_link_) && $per_link_ > 0) {
                $data = $object->orderBy('id', $orderBy)->paginate($per_link_);
            } else {
                $data = $object->orderBy('id', $orderBy)->paginate(10);
            }
            $json = collect(["message" => $message,"code" => intval($code)]) ;
            $data =  $json->merge($data);
        }else{
            $json = collect(["message" => $message,"code" => intval($code)]) ;
            $data =  $json->merge(['data'=>$data]);
//            $data = response()->json(['data'=>$data,'message'=>$message,'code'=>intval($code)],$status);
        }

        return $data;
    }
}
