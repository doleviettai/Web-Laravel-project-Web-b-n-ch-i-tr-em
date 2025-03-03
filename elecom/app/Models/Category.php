<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name'
    ];

    // phần tử cha kết nối đến con là subcategory
    public function subcategory(){
        return $this->hasMany(Subcategory::class);
    }

    // phần tử cha kết nối đến con là product
    public function product(){
        return $this->hasMany(Product::class);
    }
}
