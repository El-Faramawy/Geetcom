<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketCategory extends Model
{
    use HasFactory;

    protected $guarded = [];
    //===================  category ===========================
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    //===================  market ===========================
    public function market()
    {
        return $this->belongsTo(Market::class);
    }
//    //===================  products ===========================
//    public function products()
//    {
//        return $this->hasMany(Product::class);
//    }
}
