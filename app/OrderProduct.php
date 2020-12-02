<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_product';

    protected $fillable = ['order_id', 'product_id', 'quantity', 'unit_price'];
    public $additional_attributes = ['product_quantity'];

    public function getProductAndQuantityAttribute()
    {
        return "{$this->product_id} {$this->quantity}";
    }
}
