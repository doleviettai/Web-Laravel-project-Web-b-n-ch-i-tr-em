<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'subcategory_name',
        'category_id'
    ];


    // phần tử con kết nối đến cha là category
    public function category(){
        return $this->belongsTo(Category::class , 'category_id');
    }

    // phần tử cha kết nối đến con là product
    public function product(){
        return $this->hasMany(Product::class);
    }
}
