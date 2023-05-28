<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketSubCategory extends Model
{
    use HasFactory;
    protected $table = 'market_sub_category';
    protected $guarded = [];
    //===================  sub_category ===========================
    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }
    //===================  market ===========================
    public function market()
    {
        return $this->belongsTo(Market::class);
    }

}
