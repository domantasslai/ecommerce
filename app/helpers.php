<?php
use App\Extra\Tools;
use Carbon\Carbon;


function presentPrice($price){
  return number_format($price / 100, 2);
}

function setActiveCategory($category, $output = 'active'){
  return request()->category == $category ? $output : '';
}

function productImage($path)
{
  return $path && file_exists('storage/'.$path) ? Voyager::image($path) : asset('img/not-found.jpg');
}

function profileImage($path)
{
  return $path && file_exists('storage/'.$path) ? Voyager::image($path) : asset('img/not-found.jpg');
}

function getTaxRate($country, $vat_number){
  return Tools::getTaxRate($country, $vat_number);
}

function getNumbers()
{
    $tax = config('cart.tax') / 100;
    $discount = session()->get('coupon')['discount'] ?? 0;
    $code = session()->get('coupon')['name'] ?? null;
    $newSubtotal = (Cart::subtotal() - $discount);
    if ($newSubtotal < 0) {
        $newSubtotal = 0;
    }
    $newTax = $newSubtotal * $tax;
    $newTotal = $newSubtotal * (1 + $tax);

    return collect([
        'tax' => $tax,
        'discount' => $discount,
        'code' => $code,
        'newSubtotal' => $newSubtotal,
        'newTax' => $newTax,
        'newTotal' => $newTotal,
    ]);
}
function getStockLevel($quantity){
  if ($quantity > setting('site.stock_threshold')) {
    $stockLevel = '<div class="badge badge-success">In stock</div>';
  }elseif($quantity <= setting('site.stock_threshold') && $quantity > 0) {
    $stockLevel = '<div class="badge badge-warning">Low Stock</div>';
  } else {
    $stockLevel = '<div class="badge badge-danger">Not available</div>';
  }

  return $stockLevel;
}
