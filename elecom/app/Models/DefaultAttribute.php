<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DefaultAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'attribute_value'
    ];

    // phần tử cha kết nối đến con là product
    public function product(){
        return $this->hasMany(Product::class);
    }
}
