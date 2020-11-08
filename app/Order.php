<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Product;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
      'user_id',
      // Billing
      'billing_email', 'billing_firstName', 'billing_lastName', 'billing_address', 'billing_country',
      'billing_city', 'billing_province', 'billing_postalcode', 'billing_phone',
      // Dellivery
      'delivery_email', 'delivery_firstName', 'delivery_lastName', 'delivery_country', 'delivery_address',
      'delivery_city', 'delivery_province', 'delivery_postalcode', 'delivery_phone',
      'name_on_card', 'discount', 'discount_code', 'subtotal', 'tax', 'total', 'payment_gateway', 'payment_gateway_fee', 'shipped',
      'error', 'tax_rate', 'payment_fee', 'shipping_price'
    ];


    public function user(){
      return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}
