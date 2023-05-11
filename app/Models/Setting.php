<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = [];
    public function getLogoAttribute(){
        return  get_file($this->attributes['logo']);
    }
    public function getFavIconAttribute(){
        return  get_file($this->attributes['fav_icon']);
    }
}
