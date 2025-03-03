<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'orders_id',
        'orders_users_id',
        'orders_product',
        'orders_quantity',
        'orders_price',
        'orders_censor',
        'orders_phonenumber',
        'orders_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'orders_users_id');
    }

    public function ship()
    {
        return $this->hasMany(Shipper::class);
    }

    // public function ac_order(){
    //     return $this->belongsTo(AC_order::class , 'orders_id');
    // }
}
