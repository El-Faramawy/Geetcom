<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'cart';

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function cart_additions(){
        return $this->hasMany(CartAddition::class);
    }
}
