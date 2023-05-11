<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionProduct extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function addition(){
        return $this->belongsTo(Addition::class,'addition_id')->where('addition_category_id', null);
    }
    public function addition_with_category(){
        return $this->belongsTo(Addition::class,'addition_id')->where('addition_category_id','!=', null);
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

}
