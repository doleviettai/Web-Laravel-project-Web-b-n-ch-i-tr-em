<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_price',
        'product_cat_id',
        'product_subcat_id',
        'product_attribute_id',
        'product_status',
        'product_quantity',
        'product_img'
    ];


    // các phần từ con kết nối đến phần tử cha là category , subcategory , default_attribute
    public function category(){
        return $this->belongsTo(Category::class, 'product_cat_id');
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class, 'product_subcat_id');
    }

    public function default_attribute(){
        return $this->belongsTo(DefaultAttribute::class, 'product_attribute_id');
    }

    // phần tử cha kết nối vs AC_order
    public function AC_order(){
        return $this->hasMany(AC_order::class);
    }

    public function cartcus(){
        return $this->hasMany(CartCus::class);
    }

}
