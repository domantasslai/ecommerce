<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class onSale extends Model
{
    public function product(){
      $this->belongsTo(Product::class, 'product_id');
    }
}
