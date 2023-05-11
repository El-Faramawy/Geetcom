<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Delivery extends Authenticatable implements JWTSubject
{
    use HasFactory;
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $guarded = [];

    protected $appends = ['name'];

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

    public function getNameAttribute(){
        return $this->f_name.' '.$this->l_name;
    }

}
