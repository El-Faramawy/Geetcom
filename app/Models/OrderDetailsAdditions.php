<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetailsAdditions extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function addition(){
        return $this->belongsTo(Addition::class,'addition_id');
    }
}
