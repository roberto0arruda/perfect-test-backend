<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'product_id',
        'customer_id',
        'date',
        'quantity',
        'discount',
        'status'
    ];
}
