<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['is_rated'] ;

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function delivery(){
        return $this->belongsTo(Delivery::class,'delivery_id');
    }
    public function order_details(){
        return $this->hasMany(OrderDetails::class,'order_id');
    }
    public function coupon(){
        return $this->belongsTo(Coupon::class,'coupon_id');
    }
    public function address(){
        return $this->belongsTo(Address::class,'address_id');
    }
    public function market(){
        return $this->belongsTo(Market::class,'market_id');
    }
    public function getIsRatedAttribute(){
        return Rate::where('order_id', $this->id)->count();
    }
}
