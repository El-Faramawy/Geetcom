<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Market extends Authenticatable implements JWTSubject
{
    use HasFactory,SoftDeletes;
    protected $appends =['name','location','is_favourite'];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getImageAttribute(){
        return  get_file($this->attributes['image']);
    }
    public function getPannerAttribute(){
        return  get_file($this->attributes['panner']);
    }
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
    //===================  location ===========================
    public function getLocationAttribute(){
        $location = $this->attributes['location_ar'];
        if (request()->header('lang') && request()->header('lang') != null)
            $location = $this->attributes['location_'.request()->header('lang')];
        elseif(request()->get('lang') && request()->get('lang') != null)
            $location = $this->attributes['location_'.request()->get('lang')];
        elseif(request()->lang && request()->lang != null)
            $location = $this->attributes['location_'.request()->lang];
        return $location;
    }
    //===================  market_category ===========================
    public function market_category()
    {
        return $this->hasMany(MarketCategory::class);
    }
    //===================  market_sub_category ===========================
    public function market_sub_category()
    {
        return $this->hasMany(MarketSubCategory::class);
    }
    //===================  sub_categories ===========================
    public function sub_categories()
    {
        return $this->hasMany(SubCategory::class);
    }
//    //===================  products ===========================
    public function products()
    {
        return $this->hasMany(Product::class);
    }
//    //===================  products ===========================
    public function scopeAvailable($query)
    {
        return $query->where('is_available','yes');
    }
    //===================  IsFavourite ===========================
    public function getIsFavouriteAttribute(){
        if (user_api()->check()){
            $favourites = Favourate::where(['user_id' => user_api()->user()->id , 'market_id' => $this->attributes['id'] ] )->count();
            if ($favourites > 0)
                return 'yes';
            else
                return 'no';
        }else{
            return 'no';
        }
    }

}
