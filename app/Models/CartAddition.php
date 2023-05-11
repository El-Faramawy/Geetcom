<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartAddition extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'cart_additions';

    public function addition(){
        return $this->belongsTo(Addition::class);
    }
}
