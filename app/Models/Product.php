<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $appends =['name','description','is_favourite'];

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
    //===================  description_ar ===========================
    public function getDescriptionAttribute(){
        $description = $this->attributes['description_ar'];
        if (request()->header('lang') && request()->header('lang') != null)
            $description = $this->attributes['description_'.request()->header('lang')];
        elseif(request()->get('lang') && request()->get('lang') != null)
            $description = $this->attributes['description_'.request()->get('lang')];
        elseif(request()->lang && request()->lang != null)
            $description = $this->attributes['description_'.request()->lang];
        return $description;
    }

    public function getImageAttribute(){
        return  get_file($this->attributes['image']);
    }
    //===================  IsFavourite ===========================
    public function getIsFavouriteAttribute(){
        if (user_api()->check()){
            $favourites = Favourate::where(['user_id' => user_api()->user()->id , 'product_id' => $this->attributes['id'] ] )->count();
            if ($favourites > 0)
                return 'yes';
            else
                return 'no';
        }else{
            return 'no';
        }
    }
    //===================  scopeOffer ===========================
    public function scopeOffer($query)
    {
        return $query->where('has_offer', 'yes');
    }

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

    //===================  product_additions ===========================
    public function product_additions(){
        return $this->hasMany(AdditionProduct::class,'product_id')->whereHas('addition');
    }
    public function product_additions_with_category(){
        return $this->hasMany(AdditionProduct::class,'product_id')->whereHas('addition_with_category');
    }

    //===================  order_details ===========================
    public function order_details(){
        return $this->hasMany(OrderDetails::class,'product_id');
    }

}
