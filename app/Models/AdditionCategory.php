<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionCategory extends Model
{
    use HasFactory;

    protected $appends =['name'];
    protected $guarded = [];
    public function additions(){
        return $this->hasMany(Addition::class,'addition_category_id');
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

}
