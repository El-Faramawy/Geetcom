<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getImageAttribute(){
        return  get_file($this->attributes['image']);
    }

    public function support_products(){
        return $this->hasMany(SupportProducts::class,'support_id');
    }

}
