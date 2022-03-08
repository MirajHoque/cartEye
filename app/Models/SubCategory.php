<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table = "subcategories";

    //Mass Assignment
    protected $fillable = [
        'category_id',
        'sub_category_name_en',
        'sub_category_name_ban',
        'sub_category_slug_en',
        'sub_category_slug_ban',    
    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id', 'id');
    }
}
