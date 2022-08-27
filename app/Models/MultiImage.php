<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultiImage extends Model
{
    use HasFactory;

    protected $table = 'multiimages';

    //can not mass assign
    protected $guarded = [

    ];

    public function Product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
