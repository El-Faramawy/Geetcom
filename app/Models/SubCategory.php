<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'sub_categories';
    protected $appends =['name'];

    //===================  name ===========================
    public function getNameAttribute(){
        $name = $this->attributes['name_ar'];
        if (request()->header('lang') && request()->header('lang') != null)
            $name = $this->attributes['name_'.request()->header('lang')];
        elseif(request()->get('lang') && request()->get('lang') != null)
            $name = $this->attributes['name_'.request()->get('lang')];
        elseif(request()->lang && request()->lang != null)
            $name = $this->attributes['name_'.request()->lang];
        return $name;
    }
    //================================================
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    //================================================
    public function market(){
        return $this->belongsTo(Market::class,'market_id');
    }
    //===================  products ===========================
    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
