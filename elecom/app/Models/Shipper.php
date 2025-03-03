<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shipper extends Model
{
    use HasFactory;

    protected $fillable = [
        'ship_orders_id',
        'ship_users',
        'ship_product',
        'ship_quantity',
        'ship_price',
        'ship_phonenumber',
        'ship_address',
        'ship_thank'
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class, 'ship_orders_id');
    }
}
