<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AC_order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'order_quantity',
        'order_price'
    ];

    public function product(){
        return $this->belongsTo(Product::class , 'product_id');
    }

    // public function orders(){
    //     return $this->hasMany(Orders::class);
    // }
}
